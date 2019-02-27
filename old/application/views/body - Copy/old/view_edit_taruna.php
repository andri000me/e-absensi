<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Tambah Taruna</span><i class="fa fa-angle-right"></i><span>Biodata</span></h2></h2>
</div>
<!--//banner-->
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
					<label class="col-sm-2 control-label hor-form" for="noreg">No Daftar*</label>
					<div class="col-sm-4">
						<input type="hidden" class="form-control" name="fototaruna" id="fototaruna" value="<?php echo $data->foto;?>">
						<input type="hidden" class="form-control" name="id_taruna" id="id_taruna" value="<?php echo $data->id_taruna;?>">
						<input type="text" class="form-control" name="noreg" id="noreg" value="<?php echo $data->no_daftar;?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="nama">Nama*</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data->nama;?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="lahir">Tempat Lahir*</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="lahir" id="lahir" value="<?php echo $data->tempat_lahir;?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="jk">Jenis Kelamin</label>
					<div class="col-sm-5"><?php
						if($data->jk == 'Pria'){
							echo form_radio('jk', 'Pria', TRUE, 'class="radio-inline"').form_label('Laki-laki', 'jk');
							echo " ".form_radio('jk', 'Wanita', FALSE, 'class="radio-inline"').form_label('Perempuan', 'jk');
						}else{
							echo form_radio('jk', 'Pria', FALSE, 'class="radio-inline"').form_label('Laki-laki', 'jk');
							echo " ".form_radio('jk', 'Wanita', TRUE, 'class="radio-inline"').form_label('Perempuan', 'jk');
						}?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="tgllhr">Tanggal Lahir*</label>
					<div class="col-sm-3">
						<input type="date" class="form-control" name="tgllhr" id="tgllhr" value="<?php echo $data->tgl_lahir;?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="dikum">DIKUM*</label>
					<div class="col-sm-3"><?php
						echo form_dropdown('dikum',$Dikum, $data->dikum, 'class="form-control" required="required"');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="jurusan">Jurusan</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="jurusan" id="jurusan" value="<?php echo $data->jurusan;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="thnagr">Tahun Lulus</label>
					<div class="col-sm-3"><?php
						echo form_dropdown('thnlulus',$ThnLulus, $data->tahun_lulus, 'class="form-control"');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="uan">Nilai UAN</label>
					<div class="col-sm-2">
						<input type="number" step="0.01" class="form-control" name="uan" id="uan" value="<?php echo $data->nilai_uan;?>" onchange="handleChange(this);">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="tb">Tinggi Badan</label>
					<div class="col-sm-2">
						<input type="number" class="form-control" name="tb" id="tb" value="<?php echo $data->tb;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="bb">Berat Badan</label>
					<div class="col-sm-2">
						<input type="number" class="form-control" name="bb" id="bb" value="<?php echo $data->bb;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="agama">Agama</label>
					<div class="col-sm-3"><?php
						echo form_dropdown('agama',$Agama, $data->agama, 'class="form-control"');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="hp">No HP</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" name="hp" id="hp" value="<?php echo $data->nohp;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="asalsekolah">Asal Sekolah</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="asalsekolah" id="asalsekolah" value="<?php echo $data->asal_sekolah;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="bidang">Bidang</label>
					<div class="col-sm-3"><?php
						echo form_dropdown('bidang',$ListBidang, $data->bidang_keahlian, 'class="form-control"');?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="fotofisik">Foto</label>
					<div class="col-sm-4">
						<input type="file" class="form-control" name="fotofisik" id="fotofisik">
						<p class="help-block">File Gambar (jpg, jpeg, png, gif).</p>
					</div>
				</div>
				<?php /*
				<div class="form-group">
					<label class="col-sm-2 control-label hor-form" for="jenisbrg">Provinsi *</label>
					<div class="col-sm-4">
						<select id="propinsi" onchange="loadKabupaten()" class="form-control"><?php
							foreach ($propinsi->result() as $p) {
								echo "<option value='$p->id'>$p->nama</option>";
							}?>
						</select>
					</div>
				</div>
				<div id="kabupatenArea"></div>
				<div id="kecamatanArea"></div>
				<div id="desaArea"></div>*/?>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn-primary btn">Submit</button>
							<button class="btn-inverse btn">Reset</button>
						</div>
					</div>
				</div>
			</form><?php
		}?>
		</div>
	</div>
</div>
