<?php require 'templates/html_start.php'; ?>

<?php

    if(!auth()):
        header('Location: '. url('/login.php'));exit;
    endif;

    $errors = [];
    $success = null;

    if(isset($_POST['update-status'])):
        $booking_id = request('booking_id', 'post', 'int');

        if(!$booking_id):
            $errors['required'] = 'كل الحقول مطلوبة';
        endif;

        if(count($errors) < 1):
            update_record('tblbooking', ['status' => 0], "id=$booking_id");
            $success = 'تم الغاء الحجز بنحاح';
        endif;
    endif;

    if(isset($_POST['payment'])):
        
        $booking_id = request('booking-id', 'post', 'int');
        $amount = request('amount', 'post', 'int');
        $card_number = request('card-number', 'post', 'string');

        if(!$booking_id || !$amount || !$card_number):
            $errors['required'] = 'كل الحقول مطلوبة';
        endif;

        if(count($errors) < 1):
            update_record('tblbooking', ['payment_status' => 1], "id=$booking_id");
            $success = 'تم الدفع بنجاح';
        endif;

    endif;

?>

<?php

    $user_booking = select_records('tblbooking', "username='". auth()->EmailId ."'");

    $types = [
        'hour' => 'ساعة',
        'day' => 'يوم',
    ];

    $status = ['ملغي', 'مؤكد'];
    
    $classes = ['text-danger', 'text-success'];
?>

<?= theme_header(); ?>


<section class="my-5">
    <div class="container">
        <?php if($success !== null):?>
        <div class="alert alert-success my-4"><?= $success ?></div>
        <?php endif;?>
        <div class="mt-5 pt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary fs-5 mb-4"> حجوزاتي </h5>
            </div>

            <div class="table-responsive shadow-sm p-5 border border-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">اسم الجهاز</th>
                            <th scope="col">تاريخ الحجز</th>
                            <th scope="col">نوع المدة</th>
                            <th scope="col"> السعر الاجمالي </th>
                            <th scope="col"> الحالة </th>
                            <th scope="col"> الاجراءات </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($user_booking as $booking):?>
                        <tr>
                            <th scope="row"><?= $booking->id ?></th>
                            <td><?= $booking->device_name ?></td>
                            <td><?= $booking->booking_date ?></td>
                            <td><?= $types[$booking->booking_type] ?></td>
                            <td class="fw-bold text-primary"><?= $booking->total ?></td>
                            <td class="fw-bold <?= $classes[$booking->status] ?>"><?= $status[$booking->status] ?></td>
                            <td>
                                <div class="d-flex">
                                    <?php if($booking->status == 0 && $booking->payment_status == 0): ?>
                                    <form action="<?= url('/booking.php') ?>" method="post">
                                        <input type="hidden" name="booking_id" value="<?= $booking->id ?>">
                                        <button class=" btn btn-danger rounded-1 fw-medium ms-3" style="font-size: 14px"
                                            name="update-status">
                                            الغاء
                                            الحجز
                                        </button>
                                    </form>
                                    <?php endif; ?>

                                    <?php if($booking->payment_status == 0 && $booking->status == 1): ?>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#payment-modal"
                                        data-id="<?= $booking->id ?>" data-amount="<?= $booking->total ?>"
                                        class="btn btn-warning link-underline link-underline-opacity-0 fw-medium rounded-1 payment-btn"
                                        style="font-size: 14px;">
                                        الدفع
                                    </a>
                                    <?php elseif($booking->payment_status == 1 && $booking->status == 1):?>
                                    <a href="#"
                                        class="text-success disabled link-underline link-underline-opacity-0 fw-medium rounded-1 payment-btn"
                                        style="font-size: 14px;" disabled>
                                        تم الحجز
                                    </a>
                                    <?php endif;?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Book Now Modal -->
<div class="modal fade" id="payment-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> معلومات الدفع </h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if(count($errors) > 0): foreach($errors as $error):?>
                <div class="alert alert-danger my-3"><?= $error ?></div>
                <?php endforeach; endif;?>
                <form action="<?= url('/booking.php') ?>" method="post" class="row">
                    <input type="hidden" name="booking-id" id="booking-id">
                    <div class="col-md-6 form-group mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" class="form-control" name="amount" id="amount">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="card-number" class="form-label"> رقم البطاقة </label>
                        <input type="text" class="form-control" name="card-number" id="card-number">
                    </div>

                    <div class="col-12">
                        <button class="mt-4 px-5 btn btn-danger rounded-1 fw-bold" name="payment">ادفع الان</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php

$scripts = '<script>

        $(document).ready(function() {
            $(".payment-btn").each(function() {
                $(this).click(function() {
                    $("#booking-id").val($(this).attr("data-id"));
                    $("#amount").val($(this).attr("data-amount"));
                });
            });
        ';

    if(count($errors) > 0):
        $scripts .= "$('#payment-modal').modal('show');";
    endif;

    $scripts .= '});</script>';

?>



<?php require 'templates/html_end.php'; ?>