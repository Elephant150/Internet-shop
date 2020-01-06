<?php

namespace inetshop\base;

abstract class Controller
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $data = [];
    public $metaData = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMetaData($title = '', $desc = '', $keywords = '')
    {
        $this->metaData['title'] = $title;
        $this->metaData['desc'] = $desc;
        $this->metaData['keywords'] = $keywords;
    }
}