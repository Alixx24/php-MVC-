<?php


namespace Application\Controllers;

use Application\Model\Article as ArticleModel;
use Application\Model\Category;

class Register extends Controller
{
    public function register()
    {
        var_dump(1234);
        // $email = $_POST['email'];
        // $password = $_POST['password'];

        // // بررسی وجود ایمیل در دیتابیس (مثلاً با PDO)
        // $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        // $stmt->execute([$email]);
        // if ($stmt->rowCount() > 0) {
        //     echo json_encode(['error' => 'ایمیل قبلا ثبت شده']);
        //     exit;
        // }

        // // هش کردن رمز عبور
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // // ذخیره در دیتابیس
        // $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        // $stmt->execute([$email, $hashedPassword]);

        echo json_encode(['success' => 'ثبت نام با موفقیت انجام شد']);
    }
}
