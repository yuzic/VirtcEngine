<?
	/*
	@	для работы с пользователями
	*/
	class Users_Data extends Model{
		
		/**
		 * @desc описываем поля модели
		 */
		private static $fields = array(
			'id' => null,
			'id_user' => null,
			'fio'	=> null,
			'phone' => null,
			'adres' => null,
			'contacts' => null
			
		);
		
		/**
		 * @desc описываем настройки кеширования
		 * 
		 * @var type array
		 */
		private static $cacheSettings = array(
			'time_reload'  => 300,   // время очистки кеша
			'chached'	   => true,
            'isHot'        =>false,// подогрев кеша
			'prefix'	   =>'user_data', 
			'limit_records' => true,    //  разбивать записи по лиммитам
			'count_limit_records' => 10 // по сколько разбивать
		);
		
		public static function getRow(){

		}
			
	}