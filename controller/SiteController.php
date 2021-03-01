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

    public function about()
    {
        $params = [
            'version' => '1.0.0',

        ];
        return $this->render('about', $params);
    }

    public function contact()
    {
        // "This should be a form";
        //lets render view
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return "Handling form site controller handleContact method";

    }

}