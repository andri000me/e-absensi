<div id="content"><?php
if(isset($data_mk)){
	foreach($data_mk as $value);?>
	<div id="content-header">
	  <div id="breadcrumb">
		<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
		<a href="<?php echo base_url();?>makul/view/<?php echo $thnAjarInt;?>" class="tip-bottom"><?php echo $thnAjar;?></a><?php
		if($this->input->get('pertemuan')){?>
			<a href="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>" class="tip-bottom"><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></a>
			<a href="<?php echo current_url().'?pertemuan='.trim($this->security->xss_clean($this->input->get('pertemuan')));?>" class="current">Pertemuan <?php echo trim($this->security->xss_clean($this->input->get('pertemuan')));?> </a><?php
		}else{?>
			<a href="<?php echo current_url();?>" class="tip-bottom"><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></a><?php
		}?>
	  </div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
				  <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
					<h5><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></h5>
				  </div>
				  <div class="widget-content">
					Siahkan pilih pertemuan 1-16 untuk mengelola bahan ajar untuk Mata Kuliah <b><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></b>
					<div class="widget-box">
						<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
							<h5>PERTEMUAN</h5>
						</div>										
						<div class="widget-content">
							<form action="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>" method="GET" class="form-horizontal">
								<div class="control-group">
									<label class="control-label">Pilih Pertemuan</label>
									<div class="controls"><?php
										echo form_dropdown('pertemuan', $Pertemuan, trim($this->security->xss_clean($this->input->get('pertemuan'))), 'onchange="this.form.submit()"');?>
									</div>
								</div>
							</form>
						</div>
					</div><?php
					if($this->input->get('pertemuan')){?>
						<div class="widget-box">
							<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
								<h5>BAHAN AJAR</h5>
							</div>										
							<div class="widget-content">
								  <form action="<?php echo base_url();?>makul/entri/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>" method="post" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">Pilih Bahan Ajar</label>
										<div class="controls"><?php
											echo form_hidden('pertemuan', trim($this->security->xss_clean($this->input->get('pertemuan'))));
											echo form_dropdown('materi', $BahanAjar, null, null);?>
											<span class="help-block">Jika data bahan ajar tidak ada didalam pilihan, silahkan upload terlebih dahulu melalui link berikut <a href="<?php echo base_url();?>materi/entri"><i class="icon-upload-alt"></i> <b>upload</b></a></span>
										</div>
									</div>
									<div class="form-actions">
									  <button type="submit" class="btn btn-success">Save</button>
									</div>
								  </form>
							</div>
						</div>
						<div class="widget-box">
							<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
								<h5>DATA BAHAN AJAR</h5>
							</div>
							<div class="widget-content">
								<div class="todo">
									<ul><?php
										if(isset($GetBahanAjar)){
											foreach($GetBahanAjar as $value){?>
												<li class="clearfix">
													<div class="txt"><a href="<?php echo base_url();?>makul/view/<?php echo $value->THSHM;?>"><b><?php echo $value->NAMA_FILE; ?></b></a></div>
													<div class="pull-right"><a href="<?php echo base_url();?>makul/hapus/<?php echo $value->IDSET;?>" title="Hapus" onclick="return confirm('Anda yakin akan menghapus data ini??')"><i class="icon-remove"></i></a></div>
												</li><?php
											}?><?php
										}else{?>
											<div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Materi belum ada. Silahkan tambah materi terlebih dahulu!</div><?php
										}?>
									</ul>
								</div>
							</div>
						</div><?php
						
					}?>
				  </div>
				</div><?php
				echo $this->session->flashdata("msg");?>
			</div>      
		</div>
	</div><?php
}?>
</div>

