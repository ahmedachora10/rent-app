<?php require 'templates/html_start.php'; ?>

<?php

if(auth()):
    header('Location: '. url('/index.php')); exit;
endif;

$errors = [];

if(isset($_POST['register'])):

    $username = request('username', 'post', 'string');
    $phone_number = request('phone_number', 'post', 'string');
    $email = request('email', 'post', 'email');
    $address = request('address', 'post', 'string');
    $country = request('country', 'post', 'string');
    $city = request('city', 'post', 'string');
    $password = request('password', 'post', 'mixed');
    $confirm_password = request('confirm_password', 'post', 'mixed');

    if(!$username || !$phone_number || !$email || !$address || !$country || !$city || !$password || !$confirm_password) :
        $errors['required'] = ' الحقول مطلوبة ';
        elseif($password !== $confirm_password):
            $errors['not_equal'] = 'كلمة المرور غير متطابقة مع تأكيد كلمة المرور';
        endif;

        if(count($errors) < 1):
            $emailExists = findOne('tblusers', "EmailId='$email'");

            if(!$emailExists):
                $new_user = insert_record('tblusers', [
                    'FullName' => $username,
                    'type' => 'user',
                    'ContactNo' => $phone_number,
                    'EmailId' => $email,
                    'Address' => $address,
                    'Country' => $country,
                    'City' => $city,
                    'Password' => md5($password),
                    'RegDate' => date('Y-m-d H:i:s')
                ]);

                if($new_user):
                    user_login($new_user);
                    header('Location: '. url('/index.php')); exit;
                endif;

                $errors['not_save'] = 'حدث خطأ اثناء التسجيل';

            endif;
            $errors['unique'] = 'البريد الكتروني موجود مسبقا';
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

                        <h1 class="text-center text-primary fw-bold fs-5 px-4 py-3 border-end">حساب جديد</h1>
                    </div>

                    <hr>

                    <?php if(count($errors) > 0): foreach ($errors as $error) :?>
                    <div class="alert alert-danger mb-3"><?= $error ?></div>
                    <?php endforeach; endif;?>

                    <form action="<?= url('/register.php') ?>" method="post" class="row pt-4">
                        <div class="form-group col-md-6 mb-3">
                            <label for="username" class="form-tabel mb-3"> الاسم </label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="phone_number" class="form-tabel mb-3"> الهاتف </label>
                            <input type="text" name="phone_number" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="email" class="form-tabel mb-3"> البريد الالكتروني </label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="address" class="form-tabel mb-3"> العنوان</label>
                            <input type="text" name="address" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="country" class="form-tabel mb-3"> الدولة </label>
                            <input type="text" name="country" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="city" class="form-tabel mb-3"> المدينة </label>
                            <input type="text" name="city" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="password" class="form-tabel mb-3"> كلمة المرور </label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="confirm_password" class="form-tabel mb-3"> تأكيد كلمة المرور </label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-secondary text-white px-5 fw-bold mt-4 rounded-1"
                                name="register">تسجيل</button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <a class="text-secondary" href="<?= url('/login.php') ?>"> ألديك حساب؟ </a>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require 'templates/html_end.php'; ?>