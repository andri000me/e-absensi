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
	
	<?php
	if(isset($DataEdit)){
		foreach($DataEdit as $value);
		$judul = 'value="'.$value->JUDUL .'"';
		$deskripsi = $value->KET_FILE;
		$materi = '';
		$ketmateri = '';
		$hidden = form_hidden('IdMateri', $value->ID);
	}else{
		$judul = '';
		$deskripsi = '';
		$materi = "required";
		$ketmateri = '*';
		$hidden = '';
	}?>
	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
					  <h5>UPLOAD BAHAN AJAR</h5>
					</div>
					<div class="widget-content">
						<form enctype="multipart/form-data" action="<?php echo base_url();?>materi/simpan" method="POST" class="form-horizontal">
						<div class="control-group">
						  <label class="control-label">Judul Materi *</label>
						  <div class="controls">
						  <?php echo $hidden;?>
							<input type="text" class="span11" name="judul" placeholder="Judul Materi Ajar" <?php echo $judul;?>required />
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">Deskripsi *</label>
						  <div class="controls">
							<textarea class="textarea_editor span12" name="deskripsi" rows="6" placeholder="Enter text ..."><?php echo $deskripsi;?></textarea>
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">File Materi <?php echo $ketmateri;?></label>
						  <div class="controls">
							<input type="file" name="materi" <?php echo $materi;?> />
							<span class="help-block">Format dokumen harus berformat adobe acrobat (.pdf), adobe postScript (.ps, .eps), microsoft word (.doc,.docx) dan microsoft powerpoint (.ppt, .pptx) max 10mb</span> </div>
						</div>
						<div class="control-group">
							<label class="control-label">Sifat Dokumen *</label>
							<div class="controls"><?php
							foreach($SifatDokumen as $sifat => $nilai){
								if(isset($value->SIFAT) && $value->SIFAT == $sifat){?>
									<label>
										<input type="radio" value="<?php echo $sifat;?>" name="sifat" checked required /><?php echo $nilai;?>
									</label><?php
								}else{
									if($sifat==1){
										$checked = "checked";
									}else{
										$checked = '';
									}?>
									<label>
										<input type="radio" value="<?php echo $sifat;?>" name="sifat" <?php echo $checked;?> required /><?php echo $nilai;?>
									</label><?php
								}
							}?>
								<span class="help-block">Dokumen sangat disarankan bersifat open/publik agar dapat menaikkan penilaian webometric, jikapun harus diatur private disarankan hanya untuk dokumen tertentu saja.</span>
							</div>
						</div>
						<div class="form-actions">
						  <button type="submit" class="btn btn-success">Submit</button>
						</div>
						</form>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>DATA MATERI AJAR</h5>
					</div>
					<div class="widget-content"><?php
					if(isset($DataMateri)){?>
						<table class="table table-bordered data-table">
							<thead>
								<tr>
								  <th>Judul Materi</th>
								  <th>Tipe Dokumen</th>
								  <th>Sifat Dokumen</th>
								  <th>Tanggal Upload</th>
								  <th>Aksi</th>
								</tr>
							</thead>
							<tbody><?php
							foreach($DataMateri as $value){
								if($value->SIFAT == 1){
									$sifat = "Open/Publik";
								}else{
									$sifat = "Private/Khusus Mahasiswa";
								}
								if($value->TIPEFILE == "pdf"){
									$TipeFile = "Adobe Ccrobat (.pdf)";
								}elseif($value->TIPEFILE == "msword"){
									$TipeFile = "Microsoft Word (.doc,.docx)";
								}elseif($value->TIPEFILE == "mspowerpoint"){
									$TipeFile = "Microsoft Powerpoint (.ppt, .pptx)";
								}elseif($value->TIPEFILE == "postscript"){
									$TipeFile = "Adobe PostScript (.ps, .eps)";
								}?>
								<tr class="gradeA">
									<td>
										<a class="tip" href="<?php echo base_url();?>materi/download/<?php echo $value->NAMA_FILE;?>" title="Download"><?php echo $value->JUDUL; ?></a>
									</td>
									<td width="180"><?php echo $TipeFile; ?></td>
									<td width="160"><?php echo $sifat; ?></td>
									<td width="100"><?php echo date_format(date_create($value->CREATED), "d-m-Y H:i");?></td>								
									<td width="120"><center>
										<a href="<?php echo base_url();?>materi/edit/<?php echo $value->ID;?>" title="Edit"><i class="icon-pencil"></i> Edit</a>
										<a href="<?php echo base_url();?>materi/hapusberkas/<?php echo $value->ID;?>" title="Hapus" onclick="return confirm('Anda yakin akan menghapus data ini??')"><i class="icon-remove"></i> Hapus</a></center>
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