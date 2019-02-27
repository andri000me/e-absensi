<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Data Agama</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<?php echo $this->session->flashdata("msg");?>
		<p><a class="btn btn-primary btn-xs" href="<?php echo base_url();?>agama/entri">Tambah <span class="fa fa-plus" ></span></a></p>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
			<thead>
				<tr>
					<th width="10px">No</th>
					<th>Nama Agama</th>
					<th width="110px">Aksi</th>
				</tr>
			</thead>
			<tbody><?php 
			$no = $this->uri->segment('3') + 1;
			foreach($data_agama as $row){?>
				<tr>
					<td width="10px"><?php echo $no++;?></td>
					<td><?php echo $row->nama_agama;?></td>
					<td> 
						<a class="btn btn-primary btn-xs" href="<?php echo base_url();?>agama/edit/<?php echo $row->id_agama;?>"><span class="fa fa-edit" ></span></a>
						<a href="<?php echo base_url();?>agama/hapus/<?php echo $row->id_agama;?>"title="Hapus Kontak" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data ini??')">
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