<?
	class AdapterMysqli{
		public static $linkSelect = null;

   		/**
		 * @desc connect to bd
		 * @param array $params 
		 */
		public static function connect($params  = array()){
				$connect = mysql_connect($params['host'], $params['login'],$params['pass']);
				if (!$connect){
					throw VException::ormConnect(
						'error connect to Database:'.$params['dbname']
					);
				}
				$select = mysql_select_db($params['dbname']);
                mysql_query('SET NAMES utf8');
				if (!$select){
					throw  VException::ormConnect('database Mysqli not select');
				}
				if ($params['debug'] == true){
					echo mysql_error();
				}
				self::$linkSelect = $select;

		}

		/*
		*  @query без использования кеша
		 * @params string $sql -   
		*
		*/	
		public static function queryNoCache($sql){
			if (!is_null($sql)){
				$query = mysql_query($sql);
				if (!$query){
					    throw  VException::mysqli(mysql_error()."<<<".$sql.">>>");
				}
			}
		}
		
		public static function query(array $query){
			//echo MysqliTranlator::run($query).'<br>';
			$queryString = TMysqliTranlator::run($query);
			$config = config::load('Redis');
			$keyMd5=  $config['key_preffix'].md5($queryString);
			// проверяем наличине в кеше
			if (FactoryCache::getAdapter()->exists($keyMd5) == false){
				// устанавливаем значение кеша
	 			$result =  mysql_query(TMysqliTranlator::run($query));
				$errno = mysql_error();
				if (empty($errno)){
                    $accosResult = array();
					while ($fetch = mysql_fetch_array($result)){
						$accosResult[]=$fetch;
					}
                    FactoryCache::getAdapter()->set($keyMd5, $accosResult );
					return $accosResult;

				}else
					throw VException::mysqli($errno);

			}else{
				return FactoryCache::getAdapter()->get($keyMd5);
			}
			
			
		}	

		
	}