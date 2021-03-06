<?php


namespace app\controller;


use app\core\Controller;
use app\core\Request;
use app\model\UserModel;

class UsersController extends Controller
{
    public Validation $vld;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->vld = new Validation();
        $this->userModel = new UserModel();
    }

    public function register(Request $request)
    {
        if ($request->isGet()) {

            $this->setLayout('main');
            $data = [
                'name' => '',
                'surname' => '',
                'email' => '',
                'phoneNumber' => '',
                'address' => '',
                'password' => '',
                'confirmPassword' => '',
                'errors' => [
                    'nameErr' => '',
                    'surnameErr' => '',
                    'emailErr' => '',
                    'phoneNumberErr' => '',
                    'addressErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => '',
                ],
                'currentPage' => 'register'
            ];


            return $this->render('register', $data);
        }

        if ($request->isPost()) {
            $this->setLayout('main');
            //request is post and we need to pull user data
            $data = $request->getBody();
            $data['currentPage'] = 'register';
            // Validate name
            $data['errors']['nameErr'] = $this->vld->validateName($data['name'], 40);
            // Validate surname
            $data['errors']['surnameErr'] = $this->vld->validateSurname($data['surname'], 40);
            // Validate phone number
            if (!empty($data['phoneNumber'])) {
                $data['errors']['phoneNumberErr'] = $this->vld->isValidTelephoneNumber($data['phoneNumber'], 8, 9);
            } else {
                $data['errors']['phoneNumberErr'] = '';
            }
            if (!empty($data['address'])) {
                $data['errors']['addressErr'] = $this->vld->validateAddress($data['address'], 100);
            } else {
                $data['errors']['addressErr'] = '';
            }
            // Validate email
            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);

            // Validate password, nuo 4 iki 10 simboliu
            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 4, 10);

            // Validate confirmPassword
            $data['errors']['confirmPasswordErr'] = $this->vld->validateConfirmPassword($data['confirmPassword']);

            if ($this->vld->ifEmptyErrorsArray($data['errors'])) {

                //hash password // save way to store password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //create user
                if ($this->userModel->register($data)) {
                    //success user added
                    //set flash message
//                    flash('registerSuccess', 'You have registered successfully');
//                    header("Location: " . URLROOT . "/users/login");
                    $request->redirect('/login');
                } else {
                    die('something went wrong in adding user to db');
                }
            }
            return $this->render('register', $data);
        }
    }


    public function login(Request $request)
    {
        $this->setLayout('main');

        if ($request->isGet()) {
            $data = [
                'currentPage' => 'login',
                'email' => '',
                'password' => '',
                'errors' => [
                    'emailErr' => '',
                    'passwordErr' => '',
                ]
            ];
            return $this->render('login', $data);
        }

        if ($request->isPost()) {
            $data = $request->getBody();
            $data['currentPage'] = 'login';
            //validate email
            $data['errors']['emailErr'] = $this->vld->validateLoginEmail($data['email'], $this->userModel);

            //validate password
            $data['errors']['passwordErr'] = $this->vld->validateEmpty($data['password'], 'Please enter your password');

            if ($this->vld->ifEmptyErrorsArray($data['errors'])) {
                //check if we have errors
                //no errors
                //email was found and password was entered
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);


                if ($loggedInUser) {
                    //create session
                    //password match
                    $this->createUserSession($loggedInUser);
                    $request->redirect('/');
//                    die('email and pass match start session immediately');
                    //id, name ir email issisaugoti i sessija kai prisiloginam
                    //kai turim tuos duomeniss, galesim valdyti visa flowa
                } else {
                    $data['errors']['passwordErr'] = 'Wrong password or email';
                    //load view with errors
                    return $this->render('login', $data);
                }
            }
            return $this->render('login', $data);
        }
    }

    public function createUserSession($userRow)
    {
        $_SESSION['userId'] = $userRow->userId;
        $_SESSION['userName'] = $userRow->name;
        $_SESSION['userEmail'] = $userRow->email;
    }

    //LOGOUT
    public function logout(Request $request)
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        unset($_SESSION['userEmail']);

        session_destroy();
        $request->redirect('/');
    }

}