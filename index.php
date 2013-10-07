<?
    header('Content-type: text/html; charset=utf-8');
    require_once 'config.php';
    require "Virtc/Virtc.php";
    Virtc::Run();
    FrontController::instance()->route();
//     FactoryCache::getAdapter()->set('www',array('id'=>'test',
//                                                        'mm'=>44));
//    $test_cache =  FactoryCache::getAdapter()->get('www');
//print_r($test_cache['id']);
?>
