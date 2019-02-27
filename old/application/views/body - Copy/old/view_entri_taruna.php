<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Tambah Taruna</span><i class="fa fa-angle-right"></i><span>Indentitas Diri</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");
			if($StatusPeriode >= 1){?>
				<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>entri_taruna/<?php //echo $row->id_kat_brg;?>"><span class="fa fa-user"> Identitas Diri</span></a> <i class="fa fa-angle-right"></i>
				
				<form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url();?>entri_taruna/simpan" method="post">
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="noreg">No Daftar*</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="noreg" id="noreg" placeholder="Nomor pendaftaran" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="nama">Nama*</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Peserta" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="lahir">Tempat Lahir*</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="lahir" id="lahir" placeholder="Tempat Lahir" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="tgllhr">Tanggal Lahir*</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="tgllhr" id="tgllhr" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="jk">Jenis Kelamin</label>
						<div class="col-sm-5"><?php
							echo form_radio('jk', 'Pria', TRUE, 'class="radio-inline"').form_label('Laki-laki', 'jk');
							echo " ".form_radio('jk', 'Wanita', FALSE, 'class="radio-inline"').form_label('Perempuan', 'jk');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="dikum">DIKUM*</label>
						<div class="col-sm-3"><?php
							echo form_dropdown('dikum',$Dikum, null, 'class="form-control" required="required"');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="jurusan">Jurusan</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="thnagr">Tahun Lulus</label>
						<div class="col-sm-3"><?php
							echo form_dropdown('thnlulus',$ThnLulus, null, 'class="form-control"');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="uan">Nilai UAN</label>
						<div class="col-sm-2">
							<input type="number" step="0.01" class="form-control" name="uan" id="uan" placeholder="Nilai" onchange="handleChange(this);">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="tb">Tinggi Badan</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" name="tb" id="tb" placeholder="Tinggi">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="bb">Berat Badan</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" name="bb" id="bb" placeholder="Berat">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="agama">Agama</label>
						<div class="col-sm-3"><?php
							echo form_dropdown('agama',$Agama, null, 'class="form-control"');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="hp">No HP</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" name="hp" id="hp" placeholder="Nomor HP">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="asalsekolah">Asal Sekolah</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="asalsekolah" id="asalsekolah" placeholder="Asal Sekolah">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label hor-form" for="bidang">Bidang</label>
						<div class="col-sm-3"><?php
							echo form_dropdown('bidang',$ListBidang, null, 'class="form-control"');?>
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
