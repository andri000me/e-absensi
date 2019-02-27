<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Tambah User</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");?>
			<h4 id="forms-example" class="">Tambah User</h4><hr/>
			<form class="form-horizontal" action="<?php echo base_url();?>user/simpan" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="nama">Nama *</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="uname">Username *</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="uname" id="uname" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="upass">Password *</label>
					<div class="col-sm-3">
						<input type="password" class="form-control" name="upass" id="upass" placeholder="Password" required>
					</div>
				</div><?php /*
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="leveluser">Level *</label>
					<div class="col-sm-4"><?php 
						echo form_dropdown('leveluser',$dropdown_level, null, 'class="form-control" required="required"');?>
					</div>
				</div>*/?>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn-primary btn">Submit</button>
							<button class="btn-inverse btn">Reset</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
