<?php

namespace app\controllers;

use inetshop\App;
use inetshop\Cache;

class MainController extends AppController
{
    public function indexAction()
    {
        $posts = \R::findAll('inetshop');
        $this->setMetaData(App::$app->getProperty('shop_name'), 'description', 'html, php');
        $name = 'Tom';
        $age = 21;
        $nickname = 'Red';
        $names = ['Tom', 'Elise', 'Kate', 'Cali'];
        $cache = Cache::instance();
//        $cache->set('test', $names);
//        $cache->delete('test');
        $data = $cache->get('test');
        if (!$data){
            $cache->set('test', $names);
        }
        debug($data);
        $this->set(compact('name', 'age', 'nickname', 'names', 'posts'));
    }
}