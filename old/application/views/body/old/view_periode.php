<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Data Periode</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<?php echo $this->session->flashdata("msg");?>
		<p><a class="btn btn-primary btn-xs" href="<?php echo base_url();?>periode/entri">Tambah <span class="fa fa-plus" ></span></a></p>
		<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
			<thead>
				<tr>
					<th width="10px">No</th>
					<th>Nama Periode</th>
					<th>Status Periode</th>
					<th>Created</th>
					<th width="110px">Aksi</th>
				</tr>
			</thead>
			<tbody><?php 
			$no = $this->uri->segment('3') + 1;
			foreach($data_periode as $row){
				if($row->status_periode == 'Y'){
					$status_periode = 'Aktif';
				}else{
					$status_periode = 'Tidak Aktif';
				}?>
				<tr>
					<td width="10px"><?php echo $no++;?></td>
					<td><?php echo $row->nama_periode;?></td>
					<td><span class="label label-primary"><?php echo $status_periode;?></span></td>
					<td><?php echo date_format(date_create($row->created), "d-m-Y H:i:s");?></td>
					<td> 
						<a class="btn btn-primary btn-xs" href="<?php echo base_url();?>periode/edit/<?php echo $row->id_periode;?>"><span class="fa fa-edit" ></span></a>
						<a href="<?php echo base_url();?>periode/hapus/<?php echo $row->id_periode;?>"title="Hapus Kontak" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data ini??')">
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