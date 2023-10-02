<!-- JS here -->
<script src="<?= base_url(''); ?>/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?= base_url(''); ?>/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?= base_url(''); ?>/js/popper.min.js"></script>
<script src="<?= base_url(''); ?>/js/bootstrap.min.js"></script>
<script src="<?= base_url(''); ?>/js/owl.carousel.min.js"></script>
<script src="<?= base_url(''); ?>/js/isotope.pkgd.min.js"></script>
<script src="<?= base_url(''); ?>/js/ajax-form.js"></script>
<script src="<?= base_url(''); ?>/js/waypoints.min.js"></script>
<script src="<?= base_url(''); ?>/js/jquery.counterup.min.js"></script>
<script src="<?= base_url(''); ?>/js/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url(''); ?>/js/scrollIt.js"></script>
<script src="<?= base_url(''); ?>/js/jquery.scrollUp.min.js"></script>
<script src="<?= base_url(''); ?>/js/wow.min.js"></script>
<script src="<?= base_url(''); ?>/js/nice-select.min.js"></script>
<script src="<?= base_url(''); ?>/js/jquery.slicknav.min.js"></script>
<script src="<?= base_url(''); ?>/js/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url(''); ?>/js/plugins.js"></script>
<script src="<?= base_url(''); ?>/js/gijgo.min.js"></script>
<!--contact js-->
<script src="<?= base_url(''); ?>/js/contact.js"></script>
<script src="<?= base_url(''); ?>/js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url(''); ?>/js/jquery.form.js"></script>
<script src="<?= base_url(''); ?>/js/jquery.validate.min.js"></script>
<script src="<?= base_url(''); ?>/js/mail-script.js"></script>

<script src="<?= base_url(''); ?>/js/main.js"></script>
<script>
    window.addEventListener("load", function() {
        removeLoader();
    });

    function removeLoader() {
        setTimeout(() => {
                let loader = document.getElementById('loader');
                // hide the loader
                loader.style = 'display: none;';
            },
            1000);
    }
</script>