<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Tambah Agama</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");?>
			<h4 id="forms-example" class="">Tambah Agama</h4><hr/>
			<form class="form-horizontal" action="<?php echo base_url();?>agama/simpan" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="nama_agama">Nama Agama*</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="nama_agama" id="nama_agama" placeholder="Nama Agama" required>
					</div>
				</div>
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
