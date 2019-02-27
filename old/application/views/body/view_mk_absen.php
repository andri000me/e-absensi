<div id="content"><?php
if(isset($data_mk)){
	foreach($data_mk as $value);?>
	<div id="content-header">
	  <div id="breadcrumb">
		<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url();?>absen" class="tip-bottom"><?php echo $thnAjar;?></a><?php
		if($this->input->get('pertemuan')){?>
			<a href="<?php echo base_url();?>absen/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>" class="tip-bottom"><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></a>
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
					Siahkan pilih pertemuan 1-16 untuk mengelola Absensi Mahasiswa untuk Mata Kuliah <b><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></b> <br>

					<div class="widget-box">
						<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
							<h5>PERTEMUAN</h5>
						</div>
						<div class="widget-content">
							<form action="<?php echo base_url();?>absen/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>" method="GET" class="form-horizontal">
								<div class="control-group">
									<label class="control-label">Pilih Pertemuan</label>
									<div class="controls"><?php
										echo form_dropdown('pertemuan', $Pertemuan, trim($this->security->xss_clean($this->input->get('pertemuan'))), 'onchange="this.form.submit()"');?>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php
					if($this->input->get('pertemuan')){?>

					<div class="container-fluid">
						<div class="row-fluid">
							<div class="span12">
								<div class="widget-box">
									<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
										<h5> Absensi Mahasiswa Mata Kuliah <?php echo $value->NAMAMK;?></h5>
									</div>
									<div class="widget-content nopadding">
										<table class="table table-bordered table-striped">
										  <thead>
											<tr>
											  <th>No.</th>
											  <th>NIM</th>
											  <th>NAMA MAHASISWA</th>
											  <th>KELAS</th>
											  <th>SEMESTER</th>
											  <th>KETERANGAN</th>
											  <th>SUBMIT</th>
											</tr>
										  </thead>
										  <tbody><?php
											$no=1;
											if(isset($data_mhs)){?>
												<form action="<?php echo base_url();?>absen/simpan/<?php echo trim($this->security->xss_clean($this->input->get('pertemuan')));?>" method="POST" class="form-horizontal"><?php
												//echo form_hidden('pertemuan', trim($this->security->xss_clean($this->input->get('pertemuan'))));
												foreach($data_mhs as $value){?>
													<tr class="odd gradeX">
														<td><?php echo $no; ?></td>
													  <td><?php echo $value->IDMAHASISWA;?></td>
													  <td>
														<!-- <a href="<?php echo base_url();?>absen/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b><?php echo $value->NAMAMK;?></b></a> -->
														<?php echo $value->NAMAMHS;?>
													  </td>
													  <td><center><?php echo $value->KELAS;?></td>
														<td><center><?php echo $value->SEMESTER;?></td>
														<td>
															<div class="col-md-2">
															<select name="ket-<?php echo $value->IDMAHASISWA;?>" class="selecter_4">
			                        <option value="H">Hadir</option>
			                        <option value="S">Sakit</option>
			                        <option value="I">Izin</option>
			                        <option value="A">Alpha</option>
			                      </select>
													</div>
													</td>
												</td>
													</tr><?php $no++;
												}?>
												<div class="form-actions">
												  <button type="submit" class="btn btn-success">Submit</button>
												</div>
											</form><?php
											} else {
												$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tidak Ditemukan Data Mahasiswa di Matakuliah ini!</div>"); ?>
												<p><b>Catatan: </b> Jika daftar mahasiswa tidak muncul pada mata kuliah ini silahkan tekan tombol sinkronisasi dibawag ini</p>
												<a href="<?php echo base_url();?>home/sinkronisasi2"><button class="btn btn-info btn-mini">Sinkronisasi Mahasiswa...</button></a>
											<?php } ?>
											<?php
										}?>
										  </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				  </div>
				</div><?php
				echo $this->session->flashdata("msg");?>
			</div>
		</div>
	</div><?php
}?>
</div>
