<?php require 'templates/html_start.php'; ?>

<?php
    $allDevices = select_records('devices', 'block_status=1');

    $categories = [];

    foreach ($allDevices as $device) {
        if(!in_array($device->device_type, array_keys($categories))) {
            $device->count = 1;
            $device->name = $device->device_type;
            $categories[$device->device_type] = $device;
            continue;
        }

        $categories[$device->device_type]->count++;
    }

    $electronics = array_filter($allDevices, function ($item) {
        return $item->device_type == 'electronics';
    });

    $computers = array_filter($allDevices, function ($item) {
        return $item->device_type == 'computer';
    });

    $tools = array_filter($allDevices, function ($item) {
        return $item->device_type == 'tools';
    });

    $games = array_filter($allDevices, function ($item) {
        return $item->device_type == 'games';
    });
?>

<?= theme_header(); ?>

<section class="banner" style="background-image: url('<?= url('/img/banner.jpeg') ?>')">
    <div class="container">
        <h1 class="text-primary fw-bold text-start" style="font-size: 3rem;">
            أجِّر ووفِّر
        </h1>
        <h5 class="text-primary fw-bold float-start fs-4 bg-white" style="width: fit-content;">
            تأجير أدوات منزلية بأمان واحترافية
        </h5>
    </div>
</section>

<section class="my-5 py-5">
    <h6 class="text-center text-dark fw-bold fs-5 pt-5">
        تصفح مجموعتنا الكاملة من الأدوات المنزلية واختر ما يناسب احتياجاتك
    </h6>
    <h2 class="text-center text-primary fs-1">
        قم بالحجز الآن لتجربة مريحة وسهلة
    </h2>

</section>

<section class="categories">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <?php foreach($categories as $category): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 px-0">
                <?= category_cart("img/{$category->dimage}", $category->name, $category->count, "/category.php?category_id={$category->device_type}") ?>
            </div>
            <?php endforeach;?>
        </div>
</section>


<section class="my-5">
    <div class="container">
        <?php if(count($computers) > 0): ?>
        <div class="mt-5 pt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary fs-5 mb-3">اجهزة الحاسوب والهواتف</h5>
                <a href="" class="link-underline link-underline-opacity-0 text-dark">
                    عرض المزيد
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="owl-carousel owl-theme">
                <?php foreach($computers as $device):?>
                <div class="item my-4">
                    <?= product_cart($device->id, "img/{$device->dimage}", $device->device_name, $device->device_type) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif;?>

        <?php if(count($tools) > 0): ?>
        <div class="mt-5 pt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary fs-5 mb-3"> الادوات المنزلية </h5>
                <a href="" class="link-underline link-underline-opacity-0 text-dark">
                    عرض المزيد
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="owl-carousel owl-theme">
                <?php foreach($tools as $tool):?>
                <div class="item my-4">
                    <?= product_cart($tool->id, "img/{$tool->dimage}", $tool->device_name, $tool->device_type) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if(count($electronics) > 0): ?>
        <div class="mt-5 pt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary fs-5 mb-3"> أجهزة كهربائية </h5>
                <a href="" class="link-underline link-underline-opacity-0 text-dark">
                    عرض المزيد
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="owl-carousel owl-theme">
                <?php foreach($electronics as $tool):?>
                <div class="item my-4">
                    <?= product_cart($tool->id, "img/{$tool->dimage}", $tool->device_name, $tool->device_type) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if(count($games) > 0): ?>
        <div class="mt-5 pt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary fs-5 mb-3"> ألعاب </h5>
                <a href="" class="link-underline link-underline-opacity-0 text-dark">
                    عرض المزيد
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="owl-carousel owl-theme">
                <?php foreach($games as $game):?>
                <div class="item my-4">
                    <?= product_cart($game->id, "img/{$game->dimage}", $game->device_name, $game->device_type) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

</section>

<!-- Footer -->
<?=  theme_footer() ?>

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
            items: 2
        },
        991: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
})
</script>"; ?>

<?php require 'templates/html_end.php'; ?>