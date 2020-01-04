<?php

namespace inetshop;

class ErrorHandler
{

    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    //    виклик
    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    //    запис помилок в лог файл
    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Error text: {$message} | File: {$file} | Line: {$line}\n====================================================\n", 3, ROOT . '/tmp/log/errors.log');
    }

    //    вивід помилки на екран
    protected function displayError($errorNumber, $errorStr, $errorFile, $errorLine, $responce = 404)
    {
        http_response_code($responce); // відправка заголовку 404

        if ($responce == 404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require WWW . '/errors/development.php';
        } else {
            require WWW . '/errors/production.php';
        }
        die;
    }

}