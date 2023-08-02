<?php require 'templates/html_start.php'; ?>

<?php

    if(auth()):
        header('Location: '. url('/index.php')); exit;
    endif;

    $errors = [];

    if(isset($_POST['login'])):
    
        $username = request('username', 'post', 'string');
        $password = request('password', 'post', 'mixed');

        if(!$password || !$username):
            $errors['credentials'] = ' الحقول مطلوبة ';
        endif;

        if(count($errors) < 1):
            $password = md5($password);
            $findUser = findOne('tblusers', "FullName='$username' and Password='$password'");

            if($findUser) {
                user_login($findUser->id);
                header('Location: '. url('/index.php')); exit;
            }

            $errors['credentials'] = 'البيانات غير صحيحة';

        endif;
    endif;


?>


<section class="product-details">
    <div class="container">

        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="col-lg-8 col-md-10 col-11 my-5">

                <div class="p-5 shadow">

                    <div class="d-flex justify-content-start align-items-center">
                        <div class="text-center">
                            <img src="img/main-logo.jpeg" alt="logo" width="100" class="mx-auto">
                        </div>

                        <h1 class="text-center text-primary fw-bold fs-5 px-4 py-3 border-end"> تسجيل الدخول </h1>
                    </div>

                    <hr>

                    <?php if(isset($errors['credentials'])): ?>
                    <div class="alert alert-danger"><?= $errors['credentials'] ?></div>
                    <?php endif;?>

                    <form action="<?= url('/login.php') ?>" method="post" class="row pt-4">
                        <div class="form-group col-md-6 mb-3">
                            <label for="username" class="form-tabel mb-3">اسم المستخدم</label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="password" class="form-tabel mb-3"> كلمة المرور </label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-secondary text-white px-5 fw-bold mt-4 rounded-1"
                                name="login">الدخول</button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="row justify-content-between align-items-center">
                        <a class="text-secondary  col" href="<?= url('forgotpassword.php') ?>">هل نسيت كلمة المرور</a>
                        <a class="text-secondary text-start col" href="<?= url('/register.php') ?>"> ليس لديك حساب؟ </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require 'templates/html_end.php'; ?>