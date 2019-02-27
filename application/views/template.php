<!DOCTYPE HTML>
<html>
<head>
	<!--Header--->
	<?php $this->load->view($header); ?>
	<!--Header--->
</head>
<body>
	<!--Header-part-->
	<div id="header">
	  <!-- <h1><a class="navbar-brand" href="<?php echo base_url();?>">E-Learning</a></h1> -->
	</div>
	<?php $this->load->view($navbar); ?>
	<?php $this->load->view($sidebar); ?>
	<?php $this->load->view($body); ?>
	<?php $this->load->view($footer); ?> 
</body>
</html>

