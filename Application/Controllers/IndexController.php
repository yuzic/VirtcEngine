<?
    class IndexController extends Controller{

        public function actionIndex(){
            $this->view->start = 222;
            $this->view->render('index');
        }

        /**
         * автокоплит поиск
         */
        public function actionSearch(){
            Loader::loadHelper('Charset');
            $search = Helper_Charset::convert(
                                    Request::getPost('str')
                                );

            if (!empty($search)){
                $goodsCollection = Model_Collection_Manager::byQuery('goods_data',
                    Query::instance()
                        ->select('*')
                        ->from('goods_data','goods')
                        ->like('name=?',$search)
                );
                $search = array();
                $limit=0;
                foreach ($goodsCollection as $goods){
                   // print_r($goods);
                    $search[] = array('id'=>$goods['id'],
                        'name'=>strtolower($goods['name']),
                        'descript'=>$goods['descript']);
                    $limit++;
                    if ($limit >=10){
                        break;
                    }

                }
                echo json_encode($search);
            }

        }
    }