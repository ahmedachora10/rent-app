<?php


if(!function_exists('product_cart')):
    function product_cart($id = 0, $img = '', $title = '', $category = '', $rating = 5) {
        return '
            <div class="product-cart card rounded border-0 shadow-sm">
                <div class="position-relative shadow p-2">
                    <img src="' . url($img) . '" class="card-img-top" alt="image">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-dark" style="font-size: 1.2rem;"> ' . $title . ' </h5>
                    <h6 class="mb-3" style="color: #949ca5; font-size: 0.9rem"> ' . translate($category) . ' </h6>
    
                    <div class="reviews">
                        <div class="rateYo" data-rating="'. $rating .'"></div>
                    </div>
    
                    <hr>
                    <a href="'. url('/details.php?product_id='.$id) .'"
                        class="mt-3 text-primary d-block text-start link-underline link-underline-opacity-0">
                        تفاصيل
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        ';
    }
endif;

if(!function_exists('category_cart')):
    function category_cart($img = '', $title = '', $count = '0', $link = '#') {
        return '
            <div class="card text-bg-dark position-relative shadow-sm border border-3 border-white">
                <img src="'. url($img) .'" class="card-img" alt="image">
                <div class="card-img-overlay" style="z-index: 99;">
                    <h5 class="card-title">
                        <a href="'. url($link) .'" class="link-underline text-white link-underline-opacity-0">'. translate($title) .'
                        <span class="badge bg-dark rounded">('. $count .')</span>
                        </a>
                    </h5>
                </div>
                <div class="overlay position-absolute"
                    style="top: 0; right:0; width:100%; height: 100%; background-color: #0643703d"></div>
            </div>
        ';
    }
endif;

if(!function_exists('theme_header')):

    function theme_header() {
        require_once ROOT . 'templates' . DS . 'partials' . DS . 'header.php';
    }

endif;

if(!function_exists('theme_footer')):

    function theme_footer() {
        require_once ROOT . 'templates' . DS . 'partials' . DS . 'footer.php';
    }

endif;

if(!function_exists('product_detail')):

    function product_detail($value, $icon = 'user') {
        return '

        <div class="d-flex justify-content-start align-items-center mb-2">
            <span>
                <i class="fas fa-'.trim($icon, ' ').' ms-1 text-secondary"></i>
            </span>
            <span class="me-2 fw-bold" style="font-size: #ccc">
                '. $value.'
            </span>
        </div>

        ';
    }

endif;