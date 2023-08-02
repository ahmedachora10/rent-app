<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script src="<?= url('lib/easing/easing.min.js') ?>"></script>
<script src="<?= url('lib/owlcarousel/owl.carousel.min.js') ?>"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    -->

<script>
$(function() {

    $(".rateYo").rateYo({
        starWidth: "20px",
        rating: "95%",
        precision: 0,
        rtl: true
    });

    const menuBarButton = $('#display-menu');

    if (menuBarButton.length) {
        menuBarButton.click(function() {
            $('#menu-bar').toggleClass('d-none');
            $('#menu-bar').toggleClass('shadow-sm');
            // console.log('clicked!');
        });
    }

    // $(window).resize(function() {
    //     if (menuBarButton.hasClass('d-none') && $('#menu-bar').hasClass('shadow-sm')) {
    //         $('#menu-bar').removeClass('shadow-sm');
    //     }
    // });

    <?php if(isset($_GET['errors']) || isset($_GET['success'])): ?>
    $('#contact-us-modal').modal('show');
    console.log('running:');
    <?php endif;?>

});
</script>

<?= @$scripts ?>

</body>

</html>