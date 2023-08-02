<?php require 'templates/html_start.php'; ?>

<?php

    $id = request('category_id', 'get', 'string');

    if(!$id):
        header('Location: '. url('index.php'));exit;
    endif;

    $products = select_records('devices', "device_type='$id' and block_status=1");

?>

<?= theme_header(); ?>

<section class="my-5">
    <div class="container">
        <div class="mt-5 pt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary fs-5 mb-3"><?= translate($products[0]->device_type) ?></h5>
            </div>
            <div class="row justify-content-md-start justify-content-center align-items-start">
                <?php foreach($products as $product):?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 item my-2">
                    <?= product_cart($product->id, "img/{$product->dimage}", $product->device_name, $product->device_type) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>



<?= theme_footer(); ?>

<?php $scripts = "
<script>
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    rtl: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
})
</script>"; ?>

<?php require 'templates/html_end.php'; ?>