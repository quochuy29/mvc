<?php

namespace CONFIG;

use CONFIG\Router;
use CONFIG\Request;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        //lấy ra request 

        Router::parse($this->request->url, $this->request);
        //băm request ra thành controller action params từ Router

        $controller = $this->loadController();
        //giá trị của các thuộc tính của lớp đc tạo từ hàm loadController

        call_user_func_array([$controller, $this->request->action], $this->request->params);
        //gọi lại hàm trong loadController với action là edit thì sẽ gọi đến hàm edit
    }

    public function loadController()
    {
        $name = ucfirst($this->request->controller) . "Controller";
        $class = new \ReflectionClass('MVC\Controller\\' . $name);
        //trả lại tên lớp truyền vào từ hàm __constructor
        $controller = $class->newInstanceArgs();
        // lấy ra các thuộc tính của lớp con và lớp cha 
        return $controller;
    }
}