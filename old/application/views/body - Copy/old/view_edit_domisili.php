<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Tambah Taruna</span><i class="fa fa-angle-right"></i><span>Data Domisili</span></h2></h2>
</div>
<!--//banner-->
<script type="text/javascript">
	function loadKabupaten()
	{
		var propinsi = $("#propinsi").val();
		$.ajax({
			type:'GET',
			url:"<?php echo base_url(); ?>index.php/Entri_taruna/kabupaten",
			data:"id=" + propinsi,
			success: function(html)
			{ 
			   $("#kabupatenArea").html(html);
			}
		}); 
	}
	function loadKecamatan()
	{
		var kabupaten = $("#kabupaten").val();
		$.ajax({
			type:'GET',
			url:"<?php echo base_url(); ?>index.php/Entri_taruna/kecamatan",
			data:"id=" + kabupaten,
			success: function(html)
			{ 
				$("#kecamatanArea").html(html);
			}
		}); 
	}
	function loadDesa()
	{
		var kecamatan = $("#kecamatan").val();
		$.ajax({
			type:'GET',
			url:"<?php echo base_url(); ?>index.php/Entri_taruna/desa",
			data:"id=" + kecamatan,
			success: function(html)
			{ 
				$("#desaArea").html(html);
			}
		}); 
	}
	function handleChange(input) {
		if (input.value < 0) input.value = 0;
		if (input.value > 100) input.value = 100;
		
	}
</script>
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
					<label class="col-sm-2 control-label hor-form" for="tempat_domisili">Nama Tempat</label>
					<div class="col-sm-5">
						<input type="hidden" class="form-control" name="id_taruna" id="id_taruna" value="<?php echo $data->id_taruna;?>">
						<input type="text" class="form-control" name="tempat_domisili" id="tempat_domisili" value="<?php echo $data->tempat_domisili;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="pekerjaan">Pekerjaan</label>
					<div class="col-sm-4"><?php
						echo form_dropdown('pekerjaan',$ListJob, $data->pekerjaan, 'class="form-control"');?>
					</div>
				</div>
				<?php
				if($data->desa_domisili != ''){?>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="propinsi">Provinsi</label>
						<div class="col-sm-5"><?php
							echo form_dropdown('propinsi',$ListProv, $data->prov_ortu, 'class="form-control" id="propinsi" onchange="loadKabupaten()" disabled');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="kabupaten">Kabupaten</label>
						<div class="col-sm-5"><?php
							echo form_dropdown('kabupaten',$ListKab, $data->kab_ortu, 'class="form-control" id="kabupaten" required="required" disabled');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="kecamatan">Kecamatan</label>
						<div class="col-sm-5"><?php
							echo form_dropdown('kecamatan',$ListKec, $data->kec_ortu, 'class="form-control" id="kecamatan" required="required" disabled');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="desa">Desa</label>
						<div class="col-sm-5"><?php
							echo form_dropdown('desa',$ListDesa, $data->desa_ortu, 'class="form-control" id="desa" required="required" disabled');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="desa"></label>
						<div class="col-sm-5">
							<a href="<?php echo base_url();?>entri_taruna/edit/<?php echo $this->uri->segment(3);?>/domisili/reset"><span class="fa fa-edit"> Edit Alamat</span></a>
						</div>
					</div><?php
				}else{?>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="propinsi">Provinsi</label>
						<div class="col-sm-4"><?php
							echo form_dropdown('propinsi',$ListProv, $data->prov_domisili, 'class="form-control" id="propinsi" required="required" onchange="loadKabupaten()"');?>
						</div>
					</div>
					<div id="kabupatenArea"></div>
					<div id="kecamatanArea"></div>
					<div id="desaArea"></div><?php
				}?>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn-primary btn" name="domisili" value="1">Submit</button>
							<button class="btn-inverse btn">Reset</button>
						</div>
					</div>
				</div>
			</form><?php
		}?>
		</div>
	</div>
</div>
