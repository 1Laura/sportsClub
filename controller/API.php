<?php


namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\model\FeedbackModel;


class API extends Controller
{
    public FeedbackModel $feedbackModel;
    public Validation $vld;
    private Request $request;

    public function __construct()
    {
        $this->feedbackModel = new FeedbackModel();
        $this->vld = new Validation();
    }

    public function comments()
    {

        $comments = $this->feedbackModel->getAllFeedback();
        $data = [
            'comments' => $comments,
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function addComment(Request $request)
    {
        $result = [
            'errors' => [],
        ];
//        if (isset($_SESSION['userId'])) {
//            $result['errors'] = 'no userID given';
////            $this->request->redirect('/');
//        }

        if ($request->isPost()) {
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
                    'userName' => $_SESSION['userName'],
                    'commentBody' => $data['commentBody'],
                    'userId' => $_SESSION['userId'],
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
        }
        header('Content-Type: application/json');
        echo json_encode($result);
        die();

    }

}