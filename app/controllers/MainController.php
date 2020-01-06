<?php

namespace app\controllers;

use inetshop\App;

class MainController extends AppController
{
    public function indexAction()
    {
//        echo __METHOD__;
        $this->setMetaData(App::$app->getProperty('shop_name'), 'description', 'html, php');
        $name = 'Tom';
        $age = 21;
        $nickname = 'Red';
        $this->set(compact('name', 'age', 'nickname'));
    }
}