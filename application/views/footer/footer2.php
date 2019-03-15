</div>
<div class="row-fluid float-right mr-5 mt-4 mb-4">
    <div id="footer" class="span12"> <?= date('Y'); ?> &copy; Universitas Ubudiyah Indonesia | All Right Reserved | WebDev By<a href="https://uui.ac.id"> ICT- UUI</a> </div>
</div>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/dist/js/jquery.ui.touch-punch-improved.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/dist/js/jquery-ui.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url(); ?>template/matrix_admin/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url(); ?>template/matrix_admin/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url(); ?>template/matrix_admin/dist/js/custom.min.js"></script>
<!-- this page js -->
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/dist/js/pages/calendar/cal-init.js"></script>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<!-- this page js -->
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/toastr/build/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/dist/js/pages/mask/mask.init.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>template/matrix_admin/assets/libs/quill/dist/quill.min.js"></script>

<script>
    $('#tb_dashboard2').DataTable();
    $('#zero_config').DataTable();
    $('#tb_rwajar').DataTable();
</script>

<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*colorpicker*/
    $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',

            change: function(value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    /*datwpicker*/
    jQuery('.mydatepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd"
    });
    // var quill = new Quill('#editor', {
    //     theme: 'snow'
    // });
</script>





</body>

</html> 