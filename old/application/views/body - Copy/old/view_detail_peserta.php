<!--banner--><?php
if(empty($this->uri->segment(4))){?>
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Detail Peserta</span><a href="<?php echo base_url();?>data_taruna/view/<?php echo $this->uri->segment(3);?>/pdf" target="_blank"><i class="fa fa-print"></i> print</a></h2>
</div><?php
}else{
	echo "<script type=\"text/javascript\">window.onload=function(){window.print();}</script>";	
}?>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");
			foreach($TampilPeserta as $peserta){ ?>
			<h4 id="forms-example" class="">Detail Peserta <?php echo $peserta->nama_periode;?></h4><hr/>
			<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" border="1" width="730" style='border-collapse:collapse;' align="center">
				<tr><th width=220 colspan=2>IDENTITAS DIRI</th></tr>
				<tr><td width=220>No Pendaftaran</td><td><?php echo $peserta->no_daftar;?></td></tr>
				<tr><td width=220>Nama</td><td><?php echo $peserta->nama;?></td></tr>
				<tr><td width=220>Tempat/Tgl Lahir</td><td><?php echo $peserta->tempat_lahir;?> / <?php echo date_format(date_create($peserta->tgl_lahir), "d-m-Y");?></td></tr>
				<tr><td width=220>Jenis Kelamin</td><td><?php echo $peserta->jk;?></td></tr>
				<tr><td width=220>DIKUM</td><td><?php echo $peserta->nama_dikum;?></td></tr>
				<tr><td width=220>Jurusan</td><td><?php echo $peserta->jurusan;?></td></tr>
				<tr><td width=220>Asal Sekolah</td><td><?php echo $peserta->asal_sekolah;?></td></tr>
				<tr><td width=220>Tahun Lulus</td><td><?php echo $peserta->tahun_lulus;?></td></tr>
				<tr><td width=220>Nilai UAN</td><td><?php echo $peserta->nilai_uan;?></td></tr>
				<tr><td width=220>Tinggi Badan</td><td><?php echo $peserta->tb;?></td></tr>
				<tr><td width=220>Berat Badan</td><td><?php echo $peserta->bb;?></td></tr>
				<tr><td width=220>Agama</td><td><?php echo $peserta->nama_agama;?></td></tr>
				<tr><td width=220>Nomor HP</td><td><?php echo $peserta->nohp;?></td></tr>
				<tr><th width=220 colspan=2>DATA DOMISILI</th></tr>
				<tr><td width=220>Nama Tempat</td><td><?php echo $peserta->tempat_domisili;?></td></tr>
				<tr><td width=220>Pekerjaan</td><td><?php echo $peserta->nama_job;?></td></tr>
				<tr><td width=220>Desa Domisili</td><td><?php echo ucwords(strtolower($peserta->desa_domisili));?></td></tr>
				<tr><td width=220>Kecamatan Domisili</td><td><?php echo ucwords(strtolower($peserta->kec_domisili));?></td></tr>
				<tr><td width=220>Kabupaten Domisili</td><td><?php echo ucwords(strtolower($peserta->kab_domisili));?></td></tr>
				<tr><td width=220>Provinsi Domisili</td><td><?php echo ucwords(strtolower($peserta->prov_domisili));?></td></tr>
				<tr><th width=220 colspan=2>DATA ALAMAT</th></tr>
				<tr><td width=220>Desa</td><td><?php echo ucwords(strtolower($peserta->nama_desa));?></td></tr>
				<tr><td width=220>Kecamatan</td><td><?php echo ucwords(strtolower($peserta->nama_kec));?></td></tr>
				<tr><td width=220>Kabupaten</td><td><?php echo ucwords(strtolower($peserta->nama_kab));?></td></tr>
				<tr><td width=220>Provinsi</td><td><?php echo ucwords(strtolower($peserta->nama_prov));?></td></tr>
				<tr><th width=220 colspan=2>DATA ORANG TUA</th></tr>
				<tr><td width=220>Nama Ayah</td><td><?php echo $peserta->nama_ayah;?></td></tr>
				<tr><td width=220>Pekerjaan Ayah</td><td><?php echo $peserta->pekerjaan_ayah;?></td></tr>
				<tr><td width=220>Suku Ayah</td><td><?php echo $peserta->suku_ayah;?></td></tr>
				<tr><td width=220>Pangkat Ayah</td><td><?php echo $peserta->pangkat_ayah;?></td></tr>
				<tr><td width=220>Satuan Ayah</td><td><?php echo $peserta->satuan_ayah;?></td></tr>
				<tr><td width=220>Nama Ibu</td><td><?php echo $peserta->nama_ibu;?></td></tr>
				<tr><td width=220>Pekerjaan Ibu</td><td><?php echo $peserta->pekerjaan_ibu;?></td></tr>
				<tr><td width=220>Suku Ibu</td><td><?php echo $peserta->suku_ibu;?></td></tr>
				<tr><td width=220>Desa Orangtua</td><td><?php echo ucwords(strtolower($peserta->desa_ortu));?></td></tr>
				<tr><td width=220>Kecamatan Orangtua</td><td><?php echo ucwords(strtolower($peserta->kec_ortu));?></td></tr>
				<tr><td width=220>Kabupaten Orangtua</td><td><?php echo ucwords(strtolower($peserta->kab_ortu));?></td></tr>
				<tr><td width=220>Provinsi Orangtua</td><td><?php echo ucwords(strtolower($peserta->prov_ortu));?></td></tr>
				<tr><th width=220 colspan=2>DATA PRESTASI</th></tr>
				<tr><td width=220>Bidang</td><td><?php echo ucwords(strtolower($peserta->bidang_keahlian));?></td></tr>
				<tr><td width=220>CABOR/Keahlian</td><td><?php echo ucwords(strtolower($peserta->keahlian));?></td></tr>
				<tr><td width=220>Tingkat</td><td><?php echo ucwords(strtolower($peserta->tingkat));?></td></tr>
			</table><?php
			}?>
		</div>
	</div>
</div>
