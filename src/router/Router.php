<?php

namespace router;


use controllers\Controller;

class Router
{

    public static $list = [];

    public static function myGet(string $url, string $namePage)
    {
        self::$list[] = [
            'url' => $url,
            'namePage' => $namePage
        ];
    }

    public static function myPost(string $url, string $controller, string $method)
    {
        self::$list[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public static function getContent()
    {
        $rout = $_GET['rout'] ?? '';
        foreach (self::$list as $item)
        {
            if($item['url'] === '/' . $rout)
            {
                if ($_SERVER['REQUEST_METHOD'] === "GET")
                {
                    $obj = new Controller();
                    switch ($item['namePage'])
                    {
                        case 'home':
                            require_once __DIR__ . '/../templates/pages/' . $item['namePage'] . '.php';
                            die();
                        case 'admin':
                            $obj -> getUsers($item['namePage']);
                            die();
                        case 'catalog':
                            $obj -> getUsers($item['namePage']);
                            die();
                        case 'about':
                            $obj -> getUser($item['namePage'], $_GET['id']);
                            die();
                        case 'update':
                            $obj -> getUser($item['namePage'], $_GET['id']);
                            die();
                        case 'login':
                            require_once __DIR__ . '/../templates/pages/' . $item['namePage'] . '.php';
                            die();
                        case 'register':
                            require_once __DIR__ . '/../templates/pages/' . $item['namePage'] . '.php';
                            die();
                    }
                }
                elseif ($_SERVER['REQUEST_METHOD'] === "POST")
                {
                    $method = $item['method'];
                    switch ($method)
                    {
                        case 'add':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                        case 'delete':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                        case 'deleteImage':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                        case 'updateImage':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                        case 'redact':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                        case 'auth':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                        case 'reg':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                        case 'logout':
                            $action = new $item['controller'];
                            $action->$method();
                            die();
                    }
                }
            }
        }
    }

}