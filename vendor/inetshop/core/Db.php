<?php

namespace inetshop;

class Db
{
    use TraitSingletone;

    protected function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';
        class_alias('\RedBeanPHP\R', '\R');
        \R::setup($db['dsn'], $db['user'], $db['password']);
        if (!\R::testConnection()){
            throw new \Exception('RedBean false', 500);
        }
        \R::freeze(true);
        if (DEBUG){
            \R::debug(true, 1);
        }
    }
}