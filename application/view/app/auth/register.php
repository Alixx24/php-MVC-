<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Document</title>
    <style>
        .container-flex {
            display: flex;

            justify-content: center;
            padding: 20px;
            /* فاصله از بالا و اطراف */
            min-height: 60vh;
            /* ارتفاع صفحه */
            align-items: center;
            /* وسط چین عمودی */
        }

        .form {
            background-color: greenyellow;
        }

        /* اینجا فقط به input ها سایز میدیم */
        .email input,
        .username input,
        .password input {

            width: 300px;
            height: 40px;
            font-size: 18px;
            padding: 10px;
            box-sizing: border-box;
        }

        /* بهتره label ها رو هم کمی بزرگ کنیم */
        .email label,
        .username label,
        .password label {
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }

        /* فاصله بین فیلدها */
        .email,
        .username,
        .password {
            margin-bottom: 20px;
        }

        .submit-register {
            display: block;
            /* دکمه رو بلاک کن */
            margin: 0 auto;
            /* خودکار فاصله از چپ و راست */
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
    <div class="container-flex">
        <div class="form">
            <form action="<?php $this->url('register/register'); ?>" method="post">
                 <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="email">
                    <label for="email">Your Email</label>
                    <input type="email" name="email" id="email" />
                </div>

                <div class="username">
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username" />
                </div>

                <div class="password">
                    <label for="password">Your Password</label>
                    <input type="password" name="password" id="password" />
                </div>
                <button class="submit-register">Submit !</button>
            </form>
        </div>
    </div>
</body>

</html>