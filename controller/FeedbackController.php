<?php


namespace app\controller;


use app\core\Controller;
use app\core\Request;
use app\model\FeedbackModel;
use app\model\UserModel;

class FeedbackController extends Controller
{
    public UserModel $userModel;
    public FeedbackModel $feedbackModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->feedbackModel = new FeedbackModel();
    }

    public function index(Request $request)
    {
        $allFeedback = $this->feedbackModel->getAllFeedback();
        $data = [
            'allFeedback' => $allFeedback,
        ];

        return $this->render('/feedback', $data);
    }







}