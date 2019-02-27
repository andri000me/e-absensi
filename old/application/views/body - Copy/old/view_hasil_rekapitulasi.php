<!--banner--><?php
if(empty($this->uri->segment(3))){?>
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Rekapitulasi Peserta</span><i class="fa fa-angle-right"></i><a href="<?php echo base_url();?>report_taruna/rekapitulasi/pdf" target="_blank"><i class="fa fa-print"></i> print</a></h2>
</div><?php
}else{
	echo "<script type=\"text/javascript\">window.onload=function(){window.print();}</script>";	
}?>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<h3>Laporan : <?php echo $Periode; ?></h3><hr/>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" border="1" width="730" style='border-collapse:collapse;' align="center">
			<thead>
				<tr><th colspan=3>PEKERJAAN ORANG TUA</th></tr>
				<tr>
					<th width="10px">No</th>
					<th>Pekerjaan</th>
					<th width="250px">Jumlah</th>
				</tr>
			</thead>
			<tbody><?php
			$no = 1;
			foreach($RekapJob as $row){?>
			 <tr>
				<td width="10px"><?php echo $no++;?></td>
				<td><?php echo $row->nama_job;?></td>
				<td><?php echo $row->jlh;?></td>
				</tr><?php 
			};?>
			</tbody>
		</table>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" border="1" width="730" style='border-collapse:collapse;' align="center">
			<thead>
				<tr><th colspan=3>SUKU ORANG TUA</th></tr>
				<tr>
					<th width="10px">No</th>
					<th>Nama Suku</th>
					<th width="250px">Jumlah</th>
				</tr>
			</thead>
			<tbody><?php
			$no = 1;
			foreach($RekapSuku as $row){?>
			 <tr>
				<td width="10px"><?php echo $no++;?></td>
				<td><?php echo $row->nama_suku;?></td>
				<td><?php echo $row->jlh;?></td>
				</tr><?php 
			};?>
			</tbody>
		</table>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" border="1" width="730" style='border-collapse:collapse;' align="center">
			<thead>
				<tr><th colspan=3>DIKUM</th></tr>
				<tr>
					<th width="10px">No</th>
					<th>Nama DIKUM</th>
					<th width="250px">Jumlah</th>
				</tr>
			</thead>
			<tbody><?php
			$no = 1;
			foreach($RekapDikum as $row){?>
			 <tr>
				<td width="10px"><?php echo $no++;?></td>
				<td><?php echo $row->nama_dikum;?></td>
				<td><?php echo $row->jlh;?></td>
				</tr><?php 
			};?>
			</tbody>
		</table>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" border="1" width="730" style='border-collapse:collapse;' align="center">
			<thead>
				<tr><th colspan=3>AGAMA</th></tr>
				<tr>
					<th width="10px">No</th>
					<th>Nama Agama</th>
					<th width="250px">Jumlah</th>
				</tr>
			</thead>
			<tbody><?php
			$no = 1;
			foreach($RekapAgama as $row){?>
			 <tr>
				<td width="10px"><?php echo $no++;?></td>
				<td><?php echo $row->nama_agama;?></td>
				<td><?php echo $row->jlh;?></td>
				</tr><?php 
			};?>
			</tbody>
		</table>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" border="1" width="730" style='border-collapse:collapse;' align="center">
			<thead>
				<tr><th colspan=3>TAHUN LULUS</th></tr>
				<tr>
					<th width="10px">No</th>
					<th>Nama Tahun</th>
					<th width="250px">Jumlah</th>
				</tr>
			</thead>
			<tbody><?php
			$no = 1;
			foreach($RekapThnLulus as $row){?>
			 <tr>
				<td width="10px"><?php echo $no++;?></td>
				<td><?php echo $row->tahun_lulus;?></td>
				<td><?php echo $row->jlh;?></td>
				</tr><?php 
			};?>
			</tbody>
		</table>
	</div>
</div>