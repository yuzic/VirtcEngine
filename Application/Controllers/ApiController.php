<?php
/**
 * Created by JetBrains PhpStorm.
 * User: itcoder
 * Date: 06.10.13
 * Time: 21:48
 * To change this template use File | Settings | File Templates.
 */

class ApiController {

    public function getJsonData(){

    }

    public function actionInsert(){
        $dataArray = json_decode(Request::getPost('dataJson'),
                                 true);
        Loader::loadModel('City_Data');
        $goods = new City_Data(array(),
                                'city_data');
        set_time_limit(0);
        for ($i = 0; $i<1000000; $i++){
            $goods->_data = array('name' => 'Москва '.md5(time()),
                                  'descr'=> 'Описание '.md5(time()));
            $goods->save();
        }
//        foreach ($dataArray as $data){
//
//        }

    }

    public function actionUpdate(){
        $dataArray = json_decode(Request::getPost('dataJson'),
            true);
        Loader::loadModel('Goods_Data');
        $goods = new Goods_Data(array(),
            'goods_data');
        foreach ($dataArray as $data){
            $goods->keySet($data['id']);
            $goods->update($data);
        }
    }

    public function actionDelete(){
        $dataArray = json_decode(Request::getPost('dataJson'),
            true);
        Loader::loadModel('Goods_Data');
        $goods = new Goods_Data(array(),
                               'goods_data');
        foreach ($dataArray as $data){
            $goods->keySet($data['id']);
            $goods->delete();
        }




    }
}