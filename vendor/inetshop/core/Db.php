<?php

namespace inetshop;

class Db
{
    use TraitSingletone;

    protected function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';
    }
}