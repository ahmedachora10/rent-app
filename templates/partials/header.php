<header class="bg-white py-4 border-bottom">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-4 col-2 text-right">
                <img src="img/main-logo.jpeg" alt="LOGO" width="100">
            </div>
            <div class="col-md-8 col-10">
                <ul class="list-unstyled d-flex justify-content-end align-items-center">
                    <?php if(!auth()): ?>
                    <li class="ms-3">
                        <a href="#" class="link-underline link-underline-opacity-0" data-bs-toggle="modal"
                            data-bs-target="#login-modal">تسجيل
                            الدخول</a>
                    </li>
                    <li>
                        <a href="<?= url('/register.php') ?>"
                            class="p-3 border rounded border-primary border-2 link-underline link-underline-opacity-0"
                            data-bs-toggle="modal" data-bs-target="#register-modal">
                            حساب
                            جديد</a>
                    </li>
                    <?php else: ?>
                    <li>
                        <a class="link-underline border border-2 p-3 rounded border-primary link-underline-opacity-0 ms-3"
                            data-bs-toggle="offcanvas" href="#profile" role="button" aria-controls="profile">
                            <i class="fas fa-user"></i>
                            <?= auth()->FullName ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= url('/logout.php') ?>"
                            class="p-3 border text-danger fw-bold rounded border-danger border-2 link-underline link-underline-opacity-0">
                            الخروج
                        </a>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>
</header>

<section class="bg-white my-4">
    <div class="container">
        <div class="row justify-content-between align-items-lg-center align-items-start">
            <div class="col-10">
                <button class="btn btn-outline-secondary d-block d-lg-none" id="display-menu"><i
                        class="fas fa-bars"></i></button>
                <ul id="menu-bar"
                    class="list-unstyled flex-column mt-4 p-3 pb-lg-0 mt-lg-0 flex-lg-row align-items-start justify-content-start align-items-lg-center mb-0 px-lg-0 d-none d-lg-flex">
                    <li class="ms-3 my-lg-0 my-3">
                        <a href="<?= url('/') ?>"
                            class="link-underline link-underline-opacity-0 <?= current_uri(value: '') ?>">الرئيسية</a>
                    </li>

                    <li class="ms-3 my-lg-0 my-3">
                        <a href="<?= url('/category.php?category_id=tools') ?>"
                            class="link-underline link-underline-opacity-0 <?= current_uri(value: 'tools') ?>">الادوات
                            المنزلية</a>
                    </li>

                    <li class="ms-3 my-lg-0 my-3">
                        <a href="<?= url('/category.php?category_id=electronics') ?>"
                            class="link-underline link-underline-opacity-0 <?= current_uri(value: 'electronics') ?>">الاجهزة
                            الكهربائية</a>
                    </li>

                    <li class="ms-3 my-lg-0 my-3">
                        <a href="<?= url('/category.php?category_id=games') ?>"
                            class="link-underline link-underline-opacity-0 <?= current_uri(value: 'games') ?>">الالعاب</a>
                    </li>

                    <li class="ms-3 my-lg-0 my-3">
                        <a href="<?= url('/category.php?category_id=computer') ?>"
                            class="link-underline link-underline-opacity-0 <?= current_uri(value: 'computer') ?>">الهواتف
                            واجهزة الحاسوب</a>
                    </li>

                    <li class="ms-3 my-lg-0 my-3">
                        <a href="#" class="link-underline link-underline-opacity-0 text-dark" data-bs-toggle="modal"
                            data-bs-target="#contact-us-modal"> اتصل بنا </a>
                    </li>
                </ul>
            </div>

            <div class="col-2">
                <button class="btn btn-secondary float-start rounded text-white" data-bs-toggle="modal"
                    data-bs-target="#search-modal">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Registration Modal -->
<div class="modal fade" id="register-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h3 class="fw-bold fs-4 mb-5 text-center">اختر نوع الحساب</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="<?= url('/owner/new_user.php') ?>"
                        class="link-underline link-underline-opacity-0 bg-white shadow-sm px-5 py-4 ms-2 rounded">
                        <i class="fas fa-user-tie fa-4x"></i>
                        <h6 class="text-center fw-bold fs-6 mt-3 mb-0 text-secondary">مؤجر</h6>
                    </a>

                    <a href="<?= url('/register.php') ?>"
                        class="link-underline link-underline-opacity-0 bg-white shadow-sm px-5 py-4 me-2 rounded">
                        <i class="fas fa-user fa-4x"></i>
                        <h6 class="text-center fw-bold fs-6 mt-3 mb-0 text-secondary">عادي</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h3 class="fw-bold fs-4 mb-5 text-center">اختر نوع الحساب</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="<?= url('/owner/index.php') ?>"
                        class="link-underline link-underline-opacity-0 bg-white shadow-sm px-5 py-4 ms-2 rounded">
                        <i class="fas fa-user-tie fa-4x"></i>
                        <h6 class="text-center fw-bold fs-6 mt-3 mb-0 text-secondary">مؤجر</h6>
                    </a>

                    <a href="<?= url('/login.php') ?>"
                        class="link-underline link-underline-opacity-0 bg-white shadow-sm px-5 py-4 me-2 rounded">
                        <i class="fas fa-user fa-4x"></i>
                        <h6 class="text-center fw-bold fs-6 mt-3 mb-0 text-secondary">عادي</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Modal -->
<div class="modal fade" id="search-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5">
                <form action="<?= url('/search.php') ?>" method="get">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="text" name="search" id="search" class="form-control">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Contact Us Modal -->
<div class="modal fade" id="contact-us-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">
                    <i class="fas fa-envelope text-secondary ms-2"></i>
                    تواصل معنا
                </h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <?php if(isset($_GET['success']) || isset($_GET['errors'])): ?>
                <div class="alert alert-<?= isset($_GET['success']) ? 'success' : 'danger' ?> my-3">
                    <?= $_GET['success'] ?? $_GET['errors'] ?></div>
                <?php endif;?>
                <form action="<?= url('/contact.php') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="username" class="form-label">الاسم </label>
                            <input type="text" class="form-control" name="username">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="email" class="form-label"> البريد الالكتروني </label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <div class="col-12 form-group mb-3">
                            <label for="subject" class="form-label"> العنوان </label>
                            <input type="text" class="form-control" name="subject">
                        </div>

                        <div class="col-12 form-group mb-3">
                            <label for="message" class="form-label"> الرسالة </label>
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <button class="mt-4 px-5 btn btn-secondary text-white fw-bold rounded-1"
                        name="contact">ارسال</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if(auth()): ?>
<!-- Profile Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="profile" aria-labelledby="profileLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold text-dark" id="profileLabel">
            <i class="fas fa-user ms-2"></i>
            <?= auth()->FullName ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-unstyled">
            <li class="my-3">
                <a href="<?= url('/profile.php') ?>" class="link-underline link-underline-opacity-0 fw-bold">
                    <i class="fas fa-user-shield ms-2"></i>
                    البيانات الشخصية
                </a>
            </li>

            <li class="my-3">
                <a href="<?= url('/booking.php') ?>" class="link-underline link-underline-opacity-0 fw-bold">
                    <i class="fas fa-layer-group ms-2"></i>
                    حجوزات
                </a>
            </li>
        </ul>
    </div>
</div>
<?php endif;?>