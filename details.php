<?php require 'templates/html_start.php'; ?>

<?php

    $id = request('product_id');

    if(!$id):
        header('Location: '. url('index.php'));exit;
    endif;

    $product = findOne('devices', "id=$id and block_status=1");

    if(!$product):
        header('Location: '. url('index.php'));exit;
    endif;

    $owner = findOne('tblusers', "FullName='{$product->device_owner}'");
    if(!$owner):
        header('Location: '. url('index.php'));exit;
    endif;

    $user_rating = false;
    $user_booking = false;

    if(auth()):
        $user_rating = findOne('review_table', "device_id={$product->id} and user_name='" . auth()->EmailId . "'");
        $user_booking = findOne('tblbooking', "device_name='{$product->device_name}' and username='". auth()->EmailId ."'");
    endif;
?>

<?php

    $errors = [];
    $success = null;

    if(isset($_POST['booking-now'])):

        if(!auth()):
            header('Location: '. url('/login.php')); exit;
        endif;

        $booking_date = request('fromdate', 'post', 'date');
        $booking_duration_type = request('time', 'post', 'string');
        $booking_duration = request('duration', 'post', 'int');

        if(!$booking_date || !$booking_duration_type || !$booking_duration):
            $errors['required'] = 'كل الحقول مطلوبة';
        endif;

        $price = [
            'hour' => $product->PricePerHour,
            'day' => $product->PricePerDay,
        ];

        if(count($errors) < 1):
            $booking_already_taken = findOne('tblbooking', "booking_date='$booking_date' and device_name='{$product->device_name}'");

            if(!$booking_already_taken):
                $new_booking = insert_record('tblbooking', [
                    'device_name' => $product->device_name,
                    'booking_date' => $booking_date,
                    'booking_type' => $booking_duration_type,
                    'booking_duration' => $booking_duration,
                    'total' => $price[$booking_duration_type] * $booking_duration,
                    'username' => auth()->EmailId,
                    'device_owner' => $owner->FullName,
                    'status' => 0,
                    'payment_status' => 0,
                ]);

                if($new_booking):
                    $success = 'تم اضافة الحجز بنجاح';
                    $user_booking = findOne('tblbooking', "device_name='{$product->device_name}' and username='". auth()->EmailId ."'");
                else:
                    $errors['error'] = 'حدث خطأ اثناء الحفظ';
                endif;

            else:
                $errors['exists'] = 'لا يمكنك حجز هذا الجهاز في هذا التاريخ بسبب وجود حجز مسبق له.';
            endif;
        endif;
    endif;

    if(isset($_POST['save-rating'])):
        $rating = request('rating', 'post', 'int');
        $comment = request('comment', 'post', 'mixed');

        if(!$rating || !$comment):
            $errors['required'] = 'كل الحقول مطلوبة';
        endif;

        if(count($errors) < 1 && $user_booking):
            if($user_rating):
                update_record('review_table', [
                    'user_rating' => $rating,
                    'user_review' => $comment,
                ], "review_id={$user_rating->review_id}");
            else:
                insert_record('review_table', [
                    'device_id' => $product->id,
                    'user_name' => auth()->EmailId,
                    'user_rating' => $rating,
                    'user_review' => $comment,
                    'datetime' => time()
                ]);
            endif;
            $success = 'تم اضافة التقييم بنجاح';
            $user_rating = findOne('review_table', "device_id={$product->id} and user_name='" . auth()->EmailId . "'");
        endif;
    endif;

?>

<?= theme_header(); ?>

<section class="product-details">
    <div class="container">
        <?php if($success !== null):?>
        <div class="alert alert-success my-4"><?= $success ?></div>
        <?php endif;?>
        <h5 class="fw-bold text-primary fs-5 pb-3 mt-5 pt-5"> تفاصيل المنتج / <?= $product->device_name  ?>
        </h5>
        <hr>
        <div class="card p-3 border-0 mt-5">
            <div class="row">
                <div class="col-md-6 text-center align-self-center">
                    <div class="owl-carousel owl-theme">
                        <div class="item col-lg-8 col-md-9 col-11 mx-auto">
                            <img class="img-fluid" src="<?= url('img/'.$product->dimage) ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 info mt-md-4 mt-5">
                    <div class="row title">
                        <div class="col">
                            <h2 class="text-primary"><?= $product->device_name ?></h2>
                        </div>
                        <div class="col text-right"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                    </div>
                    <p><?= $product->device_desc ?></p>

                    <div class="reviews my-4">
                        <div class="rateYo" data-rating=""></div>
                    </div>

                    <div class="mt-3"></div>

                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6 col-12">
                            <?= product_detail($product->device_owner, 'user') ?>
                        </div>

                        <div class="col-md-6 col-12">
                            <?= product_detail($owner->EmailId, 'envelope') ?>
                        </div>

                        <div class="col-md-6 col-12">
                            <?= product_detail($owner->ContactNo, 'phone') ?>
                        </div>

                        <div class="col-md-6 col-12">
                            <?= product_detail($owner->Address, 'map') ?>
                        </div>

                        <div class="col-md-6 col-12">
                            <?= product_detail($product->PricePerHour . " ر.س للساعة", 'money-bill') ?>
                        </div>

                        <div class="col-md-6 col-12">
                            <?= product_detail($owner->City, 'city') ?>
                        </div>

                        <div class="col-md-6 col-12">
                            <?= product_detail($product->PricePerDay . ' ر.س لليوم', 'money-bill') ?>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="row justify-content-start align-items-center">
                                <div class="col-12 col-sm-auto mb-3">
                                    <a href="#" id="booking-now"
                                        class="btn btn-danger fw-bold px-5 text-white rounded-1 col-md-auto col-12"
                                        data-bs-toggle="modal" data-bs-target="#book-in-now-modal">احجز
                                        الان</a>
                                </div>
                                <?php if($user_booking && $user_booking->status == 1 && $user_booking->payment_status == 1):?>
                                <div class="col-12 col-sm-auto mb-3">
                                    <a href="#" id="booking-now"
                                        class="btn btn-warning fw-bold px-5 rounded-1 col-md-auto col-12"
                                        data-bs-toggle="modal" data-bs-target="#rating-modal">
                                        التقييم
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Book Now Modal -->
<div class="modal fade" id="book-in-now-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">احجز الان</h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if(count($errors) > 0 && isset($_POST['booking-now'])): foreach($errors as $error):?>
                <div class="alert alert-danger my-3"><?= $error ?></div>
                <?php endforeach; endif;?>
                <form action="<?= url('/details.php?product_id='.$product->id) ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="fromdate" class="form-label">تاريج الحجز</label>
                        <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" name="fromdate">
                    </div>

                    <div class="form-group mb-3">
                        <label for="time" class="form-label">نوع مدة الاستئجار</label>
                        <select name="time" id="time" class="form-control">
                            <option value="hour"> ساعة </option>
                            <option value="day"> يوم </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="duration" class="form-label"> مدة الاستئجار</label>
                        <input type="number" class="form-control" name="duration">
                    </div>

                    <button class="mt-4 px-5 btn btn-dark rounded-1" name="booking-now">احجز</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rating Modal -->
<div class="modal fade" id="rating-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    تقييم منتج <?= $product->device_name ?>
                </h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if(count($errors) > 0 && isset($_POST['save-rating'])): foreach($errors as $error):?>
                <div class="alert alert-danger my-3"><?= $error ?></div>
                <?php endforeach; endif;?>
                <form action="<?= url('/details.php?product_id='. $product->id) ?>" method="post">

                    <div class="form-group mb-3">
                        <label for="rating" class="form-label"> التقييم </label>
                        <div class="rating-booking"></div>
                        <input type="hidden" id="rating" name="rating" value="<?= @$user_rating->user_rating ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="comment" class="form-label"> التعليق </label>
                        <textarea name="comment" id="comment" cols="30" rows="5"
                            class="form-control"><?= @$user_rating->user_review ?></textarea>
                    </div>

                    <button class="mt-4 px-5 btn btn-dark rounded-1" name="save-rating">حفظ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    $scripts = "
    <script>
    $(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        rtl: true,
        items: 1
    })
    ";

    if(count($errors) > 0 && isset($_POST['booking-now'])):
        $scripts .= "$('#book-in-now-modal').modal('show');";
    endif;

    if(count($errors) > 0 && isset($_POST['save-rating'])):
        $scripts .= "$('#rating-modal').modal('show');";
    endif;

    $rate = $user_rating === false ? 0 : $user_rating->user_rating;

    $scripts .= '
        $(".rating-booking").rateYo({
            starWidth: "40px",
        rating: "'. $rate .'",
            precision: 0,
            rtl: true
        });

        $(".rating-booking").click(function() {
            const rating = $(".rating-booking").rateYo("option", "rating");

            $("#rating").val(rating);

        });

    ';

    $scripts .= "});</script>";

?>


<?php require 'templates/html_end.php'; ?>