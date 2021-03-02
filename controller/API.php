<?php


namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\model\FeedbackModel;


class API extends Controller
{
    public FeedbackModel $feedbackModel;
    public Validation $vld;

    public function __construct()
    {
        $this->feedbackModel = new FeedbackModel();
        $this->vld = new Validation();
    }

    public function comments()
    {
//        if (!\app\core\Session::isUserLoggedIn()) {
//            header('Content-Type: application/json');
//            echo json_encode(['error' => 'user is not logged in ']);
//            die();
//        }
        $comments = $this->feedbackModel->getAllFeedback();
        $data = [
            'comments' => $comments,
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function addComment()
    {
        $result = [
            'errors' => [],
        ];
        if (isset($_SESSION['userId'])) {
            $result['errors'] = 'no id given';
        }

//        if ($request->isPost()) {
            $data = [
                'commentBody' => trim($_POST['commentBody']),
                'errors' => [
                    'commentBodyErr' => '',
                ]
            ];
            $data['errors']['commentBodyErr'] = $this->vld->validateEmpty($data['commentBody'], 'Please enter your Comment');

            if ($this->vld->ifEmptyErrorsArray($data['errors'])) {
                // no errors
                // execute add post from model and get result
                $commentData = [
                    'author' => $_SESSION['userName'],
                    'commentBody' => $data['commentBody'],
                ];
                if ($this->feedbackModel->addFeedback($commentData)) {
                    $result['success'] = "Comment added";
                } else {
                    $result['errors'] = 'error adding comment';
                }
            } else {
                // create result
                $result['errors'] = $data['errors'];
            }
//            return $this->render('/feedback', $data);
//        }
        header('Content-Type: application/json');
        echo json_encode($result);
        die();

    }

}