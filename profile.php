<?php require 'templates/html_start.php'; ?>

<?php

    $user = auth();

    if(!$user) {
        header('Location: '. url('/login.php')); exit;
    }

    $errors = [];
    $success = null;

    if(isset($_POST['update-information'])):

        $username = request('username', 'post', 'string');
        $phone_number = request('phone_number', 'post', 'string');
        $email = request('email', 'post', 'email');
        $address = request('address', 'post', 'mixed');
        $country = request('country', 'post', 'mixed');
        $city = request('city', 'post', 'mixed');

        // var_dump(!$username, !$phone_number, !$email, !$address, !$country, !$city);

        if(!$username || !$phone_number || !$email || !$address || !$country || !$city) :
            $errors['required'] = ' الحقول مطلوبة ';
        endif;

        if(count($errors) < 1):
            $update_user = update_record('tblusers', [
                'FullName' => $username,
                'type' => auth()->type,
                'ContactNo' => $phone_number,
                'EmailId' => $email,
                'Address' => $address,
                'Country' => $country,
                'City' => $city,
            ], "id={$user->id}");

            if($update_user):
                $success = 'تم تحديث البيانات بنجاح';
                $user = findOne('tblusers', "id=".auth()->id);
            else:
                $errors['not_save'] = 'حدث خطأ اثناء تحديث البيانات';
            endif;
        endif;


    endif;

    if(isset($_POST['update_password'])):

        $password = request('password', 'post', 'mixed');
        $confirm_password = request('confirm_password', 'post', 'mixed');

        if( !$password || !$confirm_password):
            $errors['required'] = ' الحقول مطلوبة ';
        elseif($password !== $confirm_password):
            $errors['not_equal'] = 'كلمة المرور غير متطابقة مع تأكيد كلمة المرور';
        endif;

        if(count($errors) < 1):
            $update_user = update_record('tblusers', [
                'password' => md5($password)
            ], "id={$user->id}");

            if($update_user):
                $success = 'تم تحديث كملة المرور بنجاح';
            else:
                $errors['not_save'] = 'حدث خطأ اثناء تحديث كلمة المرور';
            endif;
        endif;
    endif;

?>

<?= theme_header(); ?>

<hr class="mt-5">

<section class="profile my-4">
    <div class="container">
        <?php if($success !== null): ?>
        <div class="alert alert-success mb-3"><?= $success ?></div>
        <?php endif;?>

        <?php if(count($errors) > 0): foreach ($errors as $error) :?>
        <div class="alert alert-danger mb-3"><?= $error ?></div>
        <?php endforeach; endif;?>
        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-md-10 pb-4">
                <div class="p-5">
                    <h3 class="fw-bold text-primary mb-4">المعلومات الشخصية</h3>
                    <form action="<?= url('/profile.php') ?>" method="post" class="row pt-4">
                        <div class="form-group col-md-6 mb-3">
                            <label for="username" class="form-tabel mb-3">اسم المستخدم</label>
                            <input type="text" name="username" value="<?= @$user->FullName ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="phone_number" class="form-tabel mb-3"> الهاتف </label>
                            <input type="text" name="phone_number" value="<?= @$user->ContactNo ?>"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="email" class="form-tabel mb-3"> البريد الالكتروني </label>
                            <input type="email" name="email" value="<?= @$user->EmailId ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="address" class="form-tabel mb-3"> العنوان</label>
                            <input type="text" name="address" value="<?= @$user->Address ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="country" class="form-tabel mb-3"> الدولة </label>
                            <input type="text" name="country" value="<?= @$user->Country ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="city" class="form-tabel mb-3"> المدينة </label>
                            <input type="text" name="city" value="<?= @$user->City ?>" class="form-control">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-secondary text-white px-5 fw-bold mt-4 rounded-1"
                                name="update-information">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="col-12">

            <div class="col-md-10 mt-5">
                <div class="p-4">
                    <h3 class="fw-bold text-primary mb-4"> تغيير كلمة المرور </h3>
                    <form action="<?= url('/profile.php') ?>" method="post" class="row pt-4">
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
                                name="update_password">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<?php require 'templates/html_end.php'; ?>