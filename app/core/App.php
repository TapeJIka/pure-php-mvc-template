<?php

class App {

    private $controller = "Home";
    private $method = "index";

    private function splitURL() {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, '/'));
        return $URL;
    }

    public function loadController() {
        $URL = $this->splitURL();
        $name = ucfirst($URL[0]);

        $filename = "../app/controllers/".$name.".php";
        /*selecting controller*/
        if (file_exists($filename))
        {
            require $filename;
            $this->controller = $name;
            unset($URL[0]);
        }else
        {
            require "../app/controllers/_404.php";
            $this->controller = "_404";
        }
        $controller = new $this->controller;
        /*selecting method*/
        if (isset($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        call_user_func_array([$controller, $this->method], $URL);
    }
}


