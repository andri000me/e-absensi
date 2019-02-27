<?php
//error_reporting(0);
session_start();
include "../../listrik.php";
ini_set('date.timezone', 'Asia/Jakarta');
$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sing - Forms</title>
    <link href="../../css/application.min.css" rel="stylesheet">
    <!-- as of IE9 cannot parse css files with more that 4K classes separating in two files -->
    <!--[if IE 9]>
        <link href="css/application-ie9-part2.css" rel="stylesheet">
    <![endif]-->
    <link rel="shortcut icon" href="../../img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
           chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
                      https://code.google.com/p/chromium/issues/detail?id=332189
        */
    </script>
</head>
<body>
<!--
  Main sidebar seen on the left. may be static or collapsing depending on selected state.

    * Collapsing - navigation automatically collapse when mouse leaves it and expand when enters.
    * Static - stays always open.
-->
<!--BAGIAN NAV-->
<?php include "../../nav.php"; ?>
<!--END BAGIAN NAV-->


<div class="content-wrap">
    <!-- main page content. the place to put widgets in. usually consists of .row > .col-md-* > .widget.  -->
    <main id="content" class="content" role="main">
		<?php 
		$aktif = 'class="active"';
		if(isset($_GET['p']) AND $_GET['p']=="cari_kurikulum"){
			include "kurikulum_form_search.php";
		}else if(isset($_GET['id_mk']) AND isset($_GET['thsm']) AND  isset($_GET['prodi']) AND isset($_GET['jenjang']) AND $_GET['aksi']=="update"){
			include "update_kurikulum_search.php";
		//Mulai KRS--meer--
		}elseif(isset($_GET['p']) AND $_GET['p']=="edit_krs"){
			include "krs_edit.php";
		}elseif(isset($_GET['p']) AND $_GET['p']=="cari_krs"){
			include "krs_cari.php";
		//Akhir KRS--meer--
		}else{?>
			<ol class="breadcrumb">
				<li>YOU ARE HERE</li>
				<li class="active">Form Elements
				</li>
			</ol><?php 
		}?>
	</main>
</div>
<!-- The Loader. Is shown when pjax happens -->
<div class="loader-wrap hiding hide">
    <i class="fa fa-circle-o-notch fa-spin-fast"></i>
</div>

<!-- common libraries. required for every page-->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/jquery-pjax/jquery.pjax.js"></script>
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js"></script>
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js"></script>
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/dropdown.js"></script>
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/button.js"></script>
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/tooltip.js"></script>
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/alert.js"></script>
<script src="../../vendor/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../vendor/widgster/widgster.js"></script>
<script src="../../vendor/pace.js/pace.min.js"></script>
<script src="../../vendor/jquery-touchswipe/jquery.touchSwipe.js"></script>

<!-- common app js -->
<script src="../../js/settings.js"></script>
<script src="../../js/app.js"></script>

<!-- page specific libs -->
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/tooltip.js"></script>
<script src="../../vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/modal.js"></script>
<script src="../../vendor/bootstrap-select/bootstrap-select.min.js"></script>
<script src="../../vendor/jquery-autosize/jquery.autosize.min.js"></script>
<script src="../../vendor/bootstrap3-wysihtml5/lib/js/wysihtml5-0.3.0.min.js"></script>
<script src="../../vendor/bootstrap3-wysihtml5/src/bootstrap3-wysihtml5.js"></script>
<script src="../../vendor/select2/select2.min.js"></script>
<script src="../../vendor/switchery/dist/switchery.min.js"></script>
<script src="../../vendor/moment/min/moment.min.js"></script>
<script src="../../vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="../../vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="../../vendor/jasny-bootstrap/js/inputmask.js"></script>
<script src="../../vendor/jasny-bootstrap/js/fileinput.js"></script>
<script src="../../vendor/holderjs/holder.js"></script>
<script src="../../vendor/dropzone/downloads/dropzone.min.js"></script>
<script src="../../vendor/markdown/lib/markdown.js"></script>
<script src="../../vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="../../vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>

<!-- page specific js -->
<script src="../../js/form-elements.js"></script>
<?php
if(isset($_GET['p']) AND $_GET['p']=="cari_kurikulum"){?>
	<!-- page specific libs -->
	<script src="../../vendor/underscore/underscore-min.js"></script>
	<script src="../../vendor/backbone/backbone.js"></script>
	<script src="../../vendor/backbone.paginator/lib/backbone.paginator.min.js"></script>
	<script src="../../vendor/backgrid/lib/backgrid.js"></script>
	<script src="../../vendor/backgrid-paginator/backgrid-paginator.js"></script>
	<script src="../../vendor/datatables/media/js/jquery.dataTables.js"></script>

	<!-- page specific js -->
	<script src="../../js/tables-dynamic.js"></script>
<?php
}?>
</body>
</html>