<?php

namespace inetshop\base;

abstract class Controller
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $layout;
    public $data = [];
    public $metaData = ['title' => '', 'desc' => '', 'keywords' => ''];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView()
    {
        $viewObject = new View($this->route, $this->layout, $this->view, $this->metaData);
        $viewObject->render($this->data);
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