<!--main-container-part-->
<div id="content">
	<!--breadcrumbs-->
	  <div id="content-header">
		<div id="breadcrumb">
			<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a href="<?php echo base_url();?>materi" class="current">Bahan Ajar</a>
		</div>
	  </div>
	<!--End-breadcrumbs-->

	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
					  <h5>UPLOAD BAHAN AJAR</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="#" method="get" class="form-horizontal">
						<div class="control-group">
						  <label class="control-label">Judul Materi</label>
						  <div class="controls">
							<input type="text" class="span11" placeholder="Judul Materi" />
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">Deskripsi</label>
						  <div class="controls">
							<textarea class="textarea_editor span12" rows="6" placeholder="Enter text ..."></textarea>
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">File upload input</label>
						  <div class="controls">
							<input type="file" />
							<span class="help-block">Format dokumen harus berformat adobe acrobat (.pdf), adobe postScript (.ps, .eps), microsoft word (.doc,.docx) dan microsoft powerpoint (.ppt, .pptx) max 10mb</span> </div>
						</div>
						<div class="form-actions">
						  <button type="submit" class="btn btn-success">Submit</button>
						</div>
						</form>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>DATA RIWAYAT MENGAJAR</h5>
					</div>
					<div class="widget-content nopadding"><?php
					if(isset($DataMateri)){?>
						<table class="table table-bordered data-table">
							<thead>
								<tr>
								  <th>Judul Materi</th>
								  <th>Tanggal Upload</th>
								  <th>Aksi</th>
								</tr>
							</thead>
							<tbody><?php
							foreach($DataMateri as $value){?>
								<tr class="gradeA">
									<td><?php echo $value->NAMA_FILE; ?></td>
									<td><?php echo $value->CREATED; ?></td>
									<td width="60"><center>
										<a class="tip" href="<?php echo base_url();?>materi/edit/<?php echo $value->ID;?>" title="Edit"><i class="icon-pencil"></i></a>
										<a class="tip" href="<?php echo base_url();?>materi/hapus/<?php echo $value->ID;?>" title="Lihat"><i class="icon-remove"></i></a></center>
									</td>
								</tr><?php
							}?>
							</tbody>
						</table><?php
					}?>
					</div>
				</div><?php
					echo $this->session->flashdata("msg");?>
			</div>
		</div>
	</div>
</div>
<!--end-main-container-part-->