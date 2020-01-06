<?php

namespace inetshop\base;

class View
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $layout;
    public $data = [];
    public $metaData = [];

    public function __construct($route, $layout = '', $view = '', $metaData)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->metaData = $metaData;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

//    формування сторінки
    public function render($data)
    {
        if (is_array($data)) extract($data);
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php"; // формування шляху до view

        if (is_file($viewFile)) {
            ob_start(); // включення буферизації
            require_once $viewFile;
            $content = ob_get_clean(); //повертається все з буферу в змінну $content
        } else {
            throw new \Exception("View {$viewFile} not found!", 500);
        }

//        підключення шаблону
        if (false !== $this->layout) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";

            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Template {$this->layout} not found!", 500);
            }
        }
    }

    public function getMetaData()
    {
        $output = '<title>' . $this->metaData['title'] . '</title>' . PHP_EOL;
        $output .= '<meta name="description" content="' . $this->metaData['desc'] . '">' . PHP_EOL;
        $output .= '<meta name="keywords" content="' . $this->metaData['keywords'] . '">' . PHP_EOL;
        return $output;
    }

}