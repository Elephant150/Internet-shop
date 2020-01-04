<?php

namespace inetshop;

class Router
{

    protected static $routes = [];
    protected static $route = [];

    //    запис правил в таблицю маршрутів
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    //    повертає таблицю маршрутів (чисто для тестування)
    public static function getRoutes()
    {
        return self::$routes;
    }

    //    повертає поточний маршрут
    public static function getRoute()
    {
        return self::$route;
    }

    //    в залежності від того що поверне matchRoute,
    //    буде повертати відповідний контроллер або помилку 404
    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

//                передача в конструктор контроллера всі параметри (для використання)
            if (class_exists($controller)) {
                 $controllerObject = new $controller(self::$route);
                 $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                 if (method_exists($controllerObject, $action)){
                      $controllerObject->$action();
                 }else{
                     throw new \Exception("Method $controller::$action not found! ", 404);
                 }
            } else {
                throw new \Exception("Controller $controller not found! ", 404);
            }
        } else {
            throw new \Exception("Page not found! ", 404);
        }
    }

    //    приймає url адресу і шукає відповідність в таблиці маршрутів
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

//    CamelCase
    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

//    camelCase
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

}