<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Cari Peserta</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");?>
			<h4 id="forms-example" class="">Filter Pencarian</h4><hr/>
			<form class="form-horizontal" action="<?php echo base_url();?>report_taruna/cari" method="post">
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="dikum">DIKUM</label>
					<div class="col-sm-4"><?php 
						echo form_dropdown('dikum',$Dikum, null, 'class="form-control"');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="jk">Jenis Kelamin</label>
					<div class="col-sm-5"><?php
						echo form_radio('jk', 'Pria', FALSE, 'class="radio-inline"').form_label('Laki-laki', 'jk');
						echo " ".form_radio('jk', 'Wanita', FALSE, 'class="radio-inline"').form_label('Perempuan', 'jk');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="agama">Agama</label>
					<div class="col-sm-3"><?php
						echo form_dropdown('agama',$Agama, null, 'class="form-control"');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="jobayah">Pekerjaan Orang Tua</label>
					<div class="col-sm-3"><?php
						echo form_dropdown('jobayah',$ListJob, null, 'class="form-control"');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="propinsi">Provinsi Asal</label>
					<div class="col-sm-3"><?php
						echo form_dropdown('propinsi',$ListProv, null, 'class="form-control"');?>
					</div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="bidang">Bidang</label>
						<div class="col-sm-3"><?php
							echo form_dropdown('bidang',$ListBidang, null, 'class="form-control"');?>
						</div>
					</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="status_lulus">Status Kelulusan</label>
					<div class="col-sm-4"><?php
						echo form_dropdown('status_lulus',$status_lulus, null, 'class="form-control"');?>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn-primary btn">Cari</button>
							<button class="btn-inverse btn">Reset</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>