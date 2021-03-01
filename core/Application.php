<?php

namespace app\core;

/**
 * Class Application
 *
 * This is main application
 *
 * @package app\core
 */
class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;

    public static Application $app;
    public Controller $controller;
    public Session $session;
    public Database $db;

    public function __construct($rootPath, $config)
    {
        $this->session = new Session();

        //static property assignment
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
        //paimam tik duomenu bazes dali
        $this->db = new Database($config['db']);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }


}