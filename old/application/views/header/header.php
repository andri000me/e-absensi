<title>E-Learning UUI</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if($this->uri->segment(1) == "makul" AND $this->uri->segment(2) == "detail"){?>
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/colorpicker.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/datepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/uniform.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/select2.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/matrix-style.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/matrix-media.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap-wysihtml5.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'><?php
}elseif(($this->uri->segment(1) == "home" AND $this->uri->segment(2) == "dataajar") OR ($this->uri->segment(1) == "materi")){?>
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/uniform.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/select2.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/matrix-style.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/matrix-media.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap-wysihtml5.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/font-awesome/css/font-awesome.css" rel="stylesheet" /><?php
}else{?>
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/fullcalendar.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/matrix-style.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/matrix-media.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url();?>template/matrix/css/jquery.gritter.css" />
	<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'><?php
}?>
