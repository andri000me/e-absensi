<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>

<!--end-Footer-part-->
<?php
if($this->uri->segment(1) == "makul" AND $this->uri->segment(2) == "detail"){?>
	<script src="<?php echo base_url();?>template/matrix/js/jquery.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.ui.custom.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/bootstrap.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/bootstrap-colorpicker.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/bootstrap-datepicker.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.toggle.buttons.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/masked.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.uniform.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/select2.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.form_common.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/wysihtml5-0.3.0.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.peity.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/bootstrap-wysihtml5.js"></script> 
	<script>
		$('.textarea_editor').wysihtml5();
	</script><?php
}elseif(($this->uri->segment(1) == "home" AND $this->uri->segment(2) == "dataajar") OR ($this->uri->segment(1) == "materi")){?>
	<script src="<?php echo base_url();?>template/matrix/js/jquery.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.ui.custom.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/bootstrap.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.uniform.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/select2.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.dataTables.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.tables.js"></script>
	 
	<script src="<?php echo base_url();?>template/matrix/js/wysihtml5-0.3.0.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/bootstrap-wysihtml5.js"></script> 
	<script>
		$('.textarea_editor').wysihtml5();
	</script>
<?php
}else{?>	
	<script src="<?php echo base_url();?>template/matrix/js/excanvas.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.ui.custom.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/bootstrap.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.flot.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.flot.resize.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.peity.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/fullcalendar.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.dashboard.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.gritter.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.interface.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.chat.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.validate.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.form_validation.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.wizard.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.uniform.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/select2.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.popover.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/jquery.dataTables.min.js"></script> 
	<script src="<?php echo base_url();?>template/matrix/js/matrix.tables.js"></script> 

	<script type="text/javascript">
	  // This function is called from the pop-up menus to transfer to
	  // a different page. Ignore if the value returned is a null string:
	  function goPage (newURL) {

		  // if url is empty, skip the menu dividers and reset the menu selection to default
		  if (newURL != "") {
		  
			  // if url is "-", it is this page -- reset the menu:
			  if (newURL == "-" ) {
				  resetMenu();            
			  } 
			  // else, send page to designated URL            
			  else {  
				document.location.href = newURL;
			  }
		  }
	  }

	// resets the menu selection upon entry to this page:
	function resetMenu() {
	   document.gomenu.selector.selectedIndex = 2;
	}
	</script><?php
}?>