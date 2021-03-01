<?php


namespace app\core;


class Request
{
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        $questionPosition = strpos($path, '?');

        if ($questionPosition !== false) :
            $path = substr($path, 0, $questionPosition);
        endif;

        //if user entered address with stash on the right we remove it
        if (strlen($path) > 1) {
            $path = rtrim($path, '/');
        }
        return $path;
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->method() === 'get';

    }

    public function isPost(): bool
    {
        return $this->method() === 'post';

    }

    public function getBody()
    {
        //store clean values
        $body = [];

        //what type of request
        // if ($this->method() === 'post') {
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        // if ($this->method() === 'get') {
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    public function redirect($whereTo)
    {
        header("Location: $whereTo");
    }


}