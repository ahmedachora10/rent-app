<?php require 'templates/html_start.php'; ?>


<section class="product-details">
    <div class="container">

        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="col-lg-8 col-md-10 col-11 my-5">

                <div class="p-5 shadow">

                    <div class="d-flex justify-content-start align-items-center">
                        <div class="text-center">
                            <img src="img/main-logo.jpeg" alt="logo" width="100" class="mx-auto">
                        </div>

                        <h1 class="text-center text-primary fw-bold fs-5 px-4 py-3 border-end"> استعادة كلمة المرور
                        </h1>
                    </div>

                    <hr>

                    <form action="" method="post" class="row pt-4">
                        <div class="form-group col-md-6 mb-3">
                            <label for="email" class="form-tabel mb-3"> البريد الالكتروني </label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="phone_number" class="form-tabel mb-3"> الهاتف </label>
                            <input type="text" name="phone_number" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="password" class="form-tabel mb-3"> كلمة المرور الجديدة </label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="password" class="form-tabel mb-3"> تأكيد كلمة المرور </label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-secondary text-white px-5 fw-bold mt-4 rounded-1">الدخول</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require 'templates/html_end.php'; ?>