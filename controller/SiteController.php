<?php


namespace app\controller;


use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'Sports club',
            'subtitle' => "Sports club home"
        ];
        return $this->render('home', $params);
    }

    public function feedback()
    {
        $params = [
            'version' => '1.0.0',
            'title' => 'feedback'

        ];
        return $this->render('feedback', $params);
    }


}