<?php

namespace Application\Controllers;

use Application\Model\Category;
use Application\Model\Article;


class Register extends Controller
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


        echo "ثبت‌نام با موفقیت انجام شد!";
        var_dump(123);
        die;
        
    }
}
