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
}
