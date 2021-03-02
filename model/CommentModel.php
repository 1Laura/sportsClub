<?php


namespace app\model;


use app\core\Application;
use app\core\Database;

class CommentModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }



}