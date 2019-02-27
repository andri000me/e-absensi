<!DOCTYPE HTML>
<html>
<head>
<title>E-ABSENSI UUI | Login ::</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="simaset, sim, manajemen, aset" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url();?>template/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo base_url();?>template/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url();?>template/css/font-awesome.css" rel="stylesheet">
<script src="<?php echo base_url();?>template/js/jquery.min.js"> </script>
<script src="<?php echo base_url();?>template/js/bootstrap.min.js"> </script>
<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap-wysihtml5.css" />
<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="login-bottom">
		<h2><center>E-ABSENSI LOGIN</center></h2>
		<form action="<?php echo base_url();?>login/login_akses" method="post">
		<div class="col-md-12">
			<div class="login-mail">
				<input type="hidden" name="key" value="da7513e2f7b4e4cad588a70d7b80a5e4">
				<input type="text" placeholder="User ID" required="" name="uIdDos">
				<i class="fa fa-user"></i>
			</div>
			<div class="login-mail">
				<input type="password" placeholder="Password" required="" name="uPassDos">
				<i class="fa fa-lock"></i>
			</div>
			<div>
				<button class="btn-primary btn">Login <span class="fa fa-sign-in"></span></button>
			</div>
		</div>
		<div class="clearfix"> </div>
		</form>
	</div>
		<!---->
		<div class="copy-right">
            <p> &copy; 2018 E-ABSENSI. All Rights Reserved. This Apps develop by ICT UUI. <!--| Template copyright <a href="http://w3layouts.com/" target="_blank">W3layouts</a>--></p></div>
<!---->
<!--scrolling js-->
	<script src="<?php echo base_url();?>template/js/jquery.nicescroll.js"></script>
	<script src="<?php echo base_url();?>template/js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>
