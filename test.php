<?php
/**
 * Created by JetBrains PhpStorm.
 * User: itcoder
 * Date: 07.10.13
 * Time: 12:19
 * To change this template use File | Settings | File Templates.
 */
set_time_limit(0);
ini_set("memory_limit", "1032M");
$connect = mysql_connect('localhost','root','virtc2012true');
mysql_select_db('search');
mysql_query('SET NAMES utf8');
$insert = null;
for ($i=0;$i<10000000; $i++){
    $generate = md5(time().mt_rand(0,50));
    $name='тестовая'.$generate;
    $descr = 'описание '.$generate;
    $insert="('{$name}','{$descr}')";
    mysql_query("INSERT INTO `search`.`city_data` (
                                                `name` ,
                                                `descr`
                                                )
             VALUES {$insert} ");

}
//$insert = mb_substr($insert,1);
//mysql_query("INSERT INTO `search`.`city_data` (
//                                                `name` ,
//                                                `descr`
//                                                )
//             VALUES {$insert}");
echo mysql_error();

