<!--banner--><?php
if(empty($this->uri->segment(3))){?>
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Data Peserta</span><i class="fa fa-angle-right"></i>
	<a href="<?php echo base_url();?>report_taruna/cari/pdf" target="_blank"><i class="fa fa-print"></i> print pdf</a><i class="fa fa-angle-right"></i>
	<a href="<?php echo base_url();?>report_taruna/cari/excel" target="_blank"><i class="fa fa-file-excel-o"></i> export ke excel</a></h2>
</div><?php
}elseif($this->uri->segment(3) == 'excel'){
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$nama_periode.xls");
	header("Pragma: no-cache");
	header("Expires: 0");?>
	<h3>Data Peserta <span><?php echo $nama_periode;?></span></h3>
	<table border="1">
		<thead>
			<tr>
				<th width="10px">No</th>
				<th>Noreg</th>
				<th>Nama</th>
				<th>Tempat/Tgl Lahir</th>
				<th>DIKUM</th>
				<th>Jenis Kelamin</th>
				<th>Jurusan</th>
				<th>Asal Sekolah</th>
				<th>Tahun Lulus</th>
				<th>Nilai UAN</th>
				<th>Tinggi Badan</th>
				<th>Berat Badan</th>
				<th>HP</th>
				<th>Agama</th>
				<th>Prov. Asal</th>
				<th>Kab. Asal</th>
				<th>Kec. Asal</th>
				<th>Desa Asal</th>				
				<th>Tempat Domilisi</th>
				<th>Pekerjaan</th>				
				<th>Prov. Domisili</th>
				<th>Kab. Domisili</th>
				<th>Kec Domisili</th>
				<th>Desa Domisili</th>
				<th>Nama Ayah</th>
				<th>Pekerjaan Ayah</th>
				<th>Suku Ayah</th>
				<th>Pangkat Ayah</th>
				<th>Satuan Ayah</th>
				<th>Nama Ibu</th>
				<th>Pekerjaan Ibu</th>
				<th>Suku Ibu</th>
				<th>Prov. Ortu</th>
				<th>Kab. Ortu</th>
				<th>Kec Ortu</th>
				<th>Desa Ortu</th>
				<th>Bidang Keahlian</th>
				<th>CABOR/Keahlian</th>
				<th>Tingkat</th>
				<th>Status Kelulusan</th>
			</tr>
		</thead>
		<tbody><?php
		$no = 1;
		foreach($TampilPeserta as $row){?>
		 <tr>
			<td width="10px"><?php echo $no++;?></td>
			<td><?php echo $row->no_daftar;?></td>
			<td><?php echo $row->nama;?></td>
			<td><?php echo $row->tempat_lahir;?> / <?php echo date_format(date_create($row->tgl_lahir), "d-m-Y");?></td>
			<td><?php echo $row->nama_dikum;?></td>			
			<td><?php echo $row->jk;?></td>
			<td><?php echo $row->jurusan;?></td>
			<td><?php echo $row->asal_sekolah;?></td>
			<td><?php echo $row->tahun_lulus;?></td>
			<td><?php echo $row->nilai_uan;?></td>
			<td><?php echo $row->tb;?></td>
			<td><?php echo $row->bb;?></td>
			<td><?php echo $row->nohp;?></td>
			<td><?php echo $row->nama_agama;?></td>
			<td><?php echo ucwords(strtolower($row->nama_prov));?></td>
			<td><?php echo ucwords(strtolower($row->nama_kab));?></td>
			<td><?php echo ucwords(strtolower($row->nama_kec));?></td>
			<td><?php echo ucwords(strtolower($row->nama_desa));?></td>
			<td><?php echo $row->tempat_domisili;?></td>
			<td><?php echo $row->nama_job;?></td>
			<td><?php echo ucwords(strtolower($row->prov_domisili));?></td>
			<td><?php echo ucwords(strtolower($row->kab_domisili));?></td>
			<td><?php echo ucwords(strtolower($row->kec_domisili));?></td>
			<td><?php echo ucwords(strtolower($row->desa_domisili));?></td>
			<td><?php echo $row->nama_ayah;?></td>
			<td><?php echo $row->pekerjaan_ayah;?></td>
			<td><?php echo $row->suku_ayah;?></td>
			<td><?php echo $row->pangkat_ayah;?></td>
			<td><?php echo $row->satuan_ayah;?></td>
			<td><?php echo $row->nama_ibu;?></td>
			<td><?php echo $row->pekerjaan_ibu;?></td>
			<td><?php echo $row->suku_ibu;?></td>
			<td><?php echo ucwords(strtolower($row->prov_ortu));?></td>
			<td><?php echo ucwords(strtolower($row->kab_ortu));?></td>
			<td><?php echo ucwords(strtolower($row->kec_ortu));?></td>
			<td><?php echo ucwords(strtolower($row->desa_ortu));?></td>			
			<td><?php echo ucwords(strtolower($row->bidang_keahlian));?></td>
			<td><?php echo ucwords(strtolower($row->keahlian));?></td>
			<td><?php echo $row->tingkat;?></td>
			<td><?php echo $row->status_kelulusan;?></td>
			</tr><?php 
		};?>
		</tbody>
	</table><?php
}elseif($this->uri->segment(3) == 'pdf'){
	echo "<script type=\"text/javascript\">window.onload=function(){window.print();}</script>";	
}
if(empty($this->uri->segment(3)) OR $this->uri->segment(3) == 'pdf'){?>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<h3>Data Peserta <span><?php echo $nama_periode;?></span></h3><hr/>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" border="1" width="730" style='border-collapse:collapse;' align="center">
			<thead>
				<tr>
					<th width="10px">No</th>
					<th>Noreg</th>
					<th>Nama</th>
					<th>DIKUM</th>
					<th>HP</th>
					<th>Agama</th>
					<th>Provinsi Asal</th>
					<th>Pekerjaan Orang Tua</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody><?php
			$no = 1;
			foreach($TampilPeserta as $row){?>
			 <tr>
				<td width="10px"><?php echo $no++;?></td>
				<td><a href="<?php echo base_url();?>data_taruna/view/<?php echo $row->id_taruna;?>"><?php echo $row->no_daftar;?></a></td>
				<td><?php echo $row->nama;?></td>
				<td><?php echo $row->nama_dikum;?></td>
				<td><?php echo $row->nohp;?></td>
				<td><?php echo $row->nama_agama;?></td>
				<td><?php echo $row->nama_prov;?></td>
				<td><?php echo $row->pekerjaan_ayah;?></td>
				<td><?php echo $row->status_kelulusan;?></td>
				</tr><?php 
			};?>
			</tbody>
		</table>
	</div>
</div><?php
}?>