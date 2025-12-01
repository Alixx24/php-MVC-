<?php

namespace Application\Controllers;

use Application\Model\Category;
use Application\Model\User as UserModel;


class Auth extends Controller
{


    public function index()
    {

        return $this->view('app.auth.register');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Invalid Request Method');
        }

        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('CSRF token failed');
        }


        $email = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();
        $userFind = $userModel->findByName($_POST['username']);


        if ($userFind != false) {
            echo "این نام کاربری انتخاب شده از پیش";
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $email = trim($_POST['email'] ?? '');
                $username = trim($_POST['username'] ?? '');
                $userPassword = $_POST['password'] ?? '';



                $password = password_hash($userPassword, PASSWORD_BCRYPT);




                $userModel = new UserModel();

                $result = $userModel->insert([
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,

                ]);

                echo "ثبت‌نام با موفقیت انجام شد!";
                var_dump($result);
                die;
            } else {
                die('ایمیل نامعتبره');
            }
        }
    }

    public function curl()
    {

        $url = 'https://backendbaz.ir/';

        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HEADER, false);

        $responseData = curl_exec($curlHandle);
        curl_close($curlHandle);
        echo $responseData;
    }

    public function sendCurl()
    {
        $url = 'https://httpbin.org/post';

        $curl = curl_init();
        $fields = array(
            'field_name_1' => 'Value 1',
            'field_name_2' => 'Value 2',
            'field_name_3' => 'Value 3'
        );

        $json_string = json_encode($fields);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($curl);

        curl_close($curl);

        echo $data;
    }


    public function all()
    {
        $user = new UserModel();
        $users = $user->all();
        var_dump($users);
        die;
    }

    public function login()
    {
        
        return $this->view('app.auth.login');
    }

    public function loginProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('invalid Request Method');
        }

        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('csrf token failed');
        }

        $userNameOrEmail = trim($_POST['usernameOrEmail'] ?? '');
        $password = $_POST['password'];

        if (empty($userNameOrEmail) || empty($password)) {
            die('لطفا نام کاربری / ایمیل و رمز عبور وارد کنید');
        }
        $userModel = new UserModel();
        $user = $userModel->findByUsernameOrEmail($userNameOrEmail);

        if (!$user) {
            die('رمز اشتباهه');
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo 'ورود موفقیت امیز بود';
    }
}
