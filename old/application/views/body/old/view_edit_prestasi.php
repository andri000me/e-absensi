<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Tambah Taruna</span><i class="fa fa-angle-right"></i><span>Data Prestasi</span></h2>
</div>
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");
			foreach($Tampil as $data){?>
			<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>entri_taruna/edit/<?php echo $this->uri->segment(3);?>"><span class="fa fa-user"> Biodata</span></a> <i class="fa fa-angle-right"></i>			
			<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>entri_taruna/edit/<?php echo $this->uri->segment(3);?>/domisili"><span class="fa fa-home"> Domisili</span></a> <i class="fa fa-angle-right"></i>
			<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>entri_taruna/edit/<?php echo $this->uri->segment(3);?>/alamat"><span class="fa fa-book"> Alamat</span></a> <i class="fa fa-angle-right"></i>
			<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>entri_taruna/edit/<?php echo $this->uri->segment(3);?>/ortu"><span class="fa fa-users"> Orang Tua</span></a> <i class="fa fa-angle-right"></i>
			<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>entri_taruna/edit/<?php echo $this->uri->segment(3);?>/prestasi"><span class="fa fa-gift"> Prestasi</span></a>
			<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>entri_taruna/edit/<?php echo $this->uri->segment(3);?>/kelulusan"><span class="fa fa-trophy"> Status Kelulusan</span></a><hr/>
			
			<form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url();?>entri_taruna/simpan" method="post">
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="keahlian">CABOR/Keahlian</label>
					<div class="col-sm-7">
						<input type="hidden" class="form-control" name="id_taruna" id="id_taruna" value="<?php echo $data->id_taruna;?>">
						<input type="text" class="form-control" name="keahlian" id="keahlian" value="<?php echo $data->keahlian;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="tingkat">Tingkat</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="tingkat" id="tingkat" value="<?php echo $data->tingkat;?>">
					</div>
				</div>				
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn-primary btn" name="prestasi" value="1">Submit</button>
							<button class="btn-inverse btn">Reset</button>
						</div>
					</div>
				</div>
			</form><?php
			}?>
		</div>
	</div>
</div>
