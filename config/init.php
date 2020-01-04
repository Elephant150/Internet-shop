<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("APP", ROOT . '/app');
define("COMPONENT", ROOT . '/components');
define("CONFIG", ROOT . '/config');
define("WWW", ROOT . '/public');
define("CACHE", ROOT . '/tmp/cache');
define("CORE", ROOT . '/vendor/inetshop/core');
define("LIBS", ROOT . '/vendor/inetshop/core/libs');
define("LAYOUT", 'default');

// http://internet-shop/public/index.php
$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
// http://internet-shop/public/
$app_path = preg_replace("#[^/]+$#", '', $app_path);
// http://internet-shop
$app_path = str_replace('/public/', '', $app_path);
define("PATH", $app_path);
define("ADMIN", PATH . '/admin');

require_once ROOT . '/vendor/autoload.php';