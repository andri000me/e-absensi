<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Data Peserta</span><i class="fa fa-angle-right"></i><span><?php echo $nama_periode;?></span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<?php echo $this->session->flashdata("msg");?>	
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
			<thead>
				<tr>
					<th width="10px">No</th>
					<th>NoReg</th>
					<th>Nama</th>
					<th>DIKUM</th>
					<th>UAN</th>
					<th>TB</th>
					<th>BB</th>
					<th>HP</th>
					<th>Status</th>
					<th width="110px">Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			//echo "ini".$this->uri->segment('2');
			$no = $this->uri->segment('3') + 1;
			foreach($data_taruna as $row){?>
			 <tr>
				<td width="10px"><?php echo $no++;?></td>
				<td><a href="<?php echo base_url();?>data_taruna/view/<?php echo $row->id_taruna;?>"><?php echo $row->id_taruna;?></a></td>
				<td>
					<?php echo $row->nama;
					if($row->foto != ''){?>
						<a href="<?php echo base_url();?>data_taruna/download/<?php echo $row->foto;?>"><span class="label label-default">foto</span></a><?php
					}?>
				</td>
				<td><?php echo $row->nama_dikum;?></td>
				<td><?php echo $row->nilai_uan;?></td>
				<td><?php echo $row->tb;?></td>
				<td><?php echo $row->bb;?></td>
				<td><?php echo $row->nohp;?></td>
				<td><?php echo $row->status_kelulusan;?></td>
				<td>
					<a class="btn btn-primary btn-xs" href="<?php echo base_url();?>entri_taruna/edit/<?php echo $row->id_taruna;?>"><span class="fa fa-edit" ></span></a>
					<a href="<?php echo base_url();?>entri_taruna/hapus/<?php echo $row->id_taruna;?>"title="Hapus Kontak" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data ini??')">
						<span class="fa fa-trash"></span>
					</a>
				</td>
				</tr><?php 
			};?>
			</tbody>
		</table>
		<p><?php echo $this->pagination->create_links();?></p>
	</div>
</div>