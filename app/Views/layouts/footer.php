</div>
<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap-select/dists/js/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/swiper/swiper-bundle.min.js'); ?>"></script>
<!-- Swiper -->
<script src="<?php echo base_url('assets/vendors/nouislider/nouislider.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dz.carousel.js'); ?>"></script>
<!-- Swiper -->
<script src="<?php echo base_url('assets/vendors/wnumb/wNumb.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/noui-slider.init.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap-touchspin/dists/jquery.bootstrap-touchspin.min.js'); ?>"></script>
<!-- Swiper -->
<script src="<?php echo base_url('assets/js/settings.js'); ?>"></script>
<!-- setting.js -->
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<?php if (isset($js_critical)) {
    echo $js_critical;
}; ?>

<script>
    $(".stepper").TouchSpin();
</script>
</body>

</html>