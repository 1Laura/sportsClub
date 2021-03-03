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
    public Validation $vld;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->feedbackModel = new FeedbackModel();
        $this->vld = new Validation();
    }


    public function index(Request $request)
    {
        $this->setLayout('feedbackLayout');
//        $allFeedback = $this->feedbackModel->getAllFeedback();
//        $data = [
//            'allFeedback' => $allFeedback,
//        ];
//        return $this->render('/feedback', $data);
//    }
//    public function addFeedback(Request $request)
//    {
        if ($request->isGet()) {
            $allFeedback = $this->feedbackModel->getAllFeedback();
            $data = [
                'allFeedback' => $allFeedback,
                'currentPage' => 'feedback',
                'text' => '',
                'errors' => [
                    'textErr' => '',
                ],
            ];
            return $this->render('feedback', $data);
        }

        if ($request->isPost()) {
            $data = $request->getBody();
            $data['userId'] = $_SESSION['userId'];
            $data['currentPage'] = 'feedback';
            $data['errors']['textErr'] = $this->vld->validateFeedback($data['text'], 500);
            if (empty($data['errors']['textErr']) && isset($data['userId'])) {
                if ($this->feedbackModel->addFeedback($data)) {
                    $request->redirect('feedback');
                } else {
                    die('something went wrong in adding feedback');
                }
            } else {
                return $this->render('feedback', $data);
            }
            return $this->render('feedback', $data);
        }

    }

    public function deleteComment(Request $request, $urlParam = null)
    {
        if ($request->isPost()) {
            $id = $urlParam['value'];
            if ($this->feedbackModel->deleteComment($id)) {
                $request->redirect('feedback');
            }
        }

    }


}