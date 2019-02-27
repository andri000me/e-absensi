<!--main-container-part-->
<div id="content">
	<!--breadcrumbs-->
	  <div id="content-header">
		<div id="breadcrumb">
			<a href="<?php echo base_url();?>home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a title="Laporan" class="current"><i class="icon-bottom"></i>Laporan</a>
		</div>

	  </div>
	<!--End-breadcrumbs-->

	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
        <div class="widget-box">
					<?php
					if(isset($data_mkterkini)){?>
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>DATA AJAR TERKINI (<?php echo $thnAjar;?>)</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
								  <th>No</th>
								  <th>ID Makul</th>
								  <th>Nama Makul</th>
								  <th>Program Studi</th>
								  <th>KELAS</th>
								  <th>SEMESTER</th>
								  <th>Cetak</th>
								  <th>Action</th>
								</tr>
							</thead>
							<tbody><?php
							$no=1;
							foreach($data_mkterkini as $value){?>
								<tr class="odd gradeX">
								  <td width="20" style="text-align: center;" ><?php echo $no;?></td>
								  <td width="70" style="text-align: center;"><?php echo $value->IDMAKUL;?></td>
								  <td>
									<!-- <a href="<?php echo base_url();?>Makul/laporan/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b><?php echo $value->NAMAMK;?></b></a> -->
									<b><?php echo $value->NAMAMK;?></b>
								  </td>
								  <td width="180"><?php echo $value->NMPSTMSPST;?></td>
								  <td width="25" style="text-align: center;">
										<?php
										if ($value->NAMAKLS == 01) {
											$kelas = "A";
										} elseif ($value->NAMAKLS == 02) {
											$kelas = "B";
										}else {
											$kelas = "NR";
										}
										echo $kelas;
										 ?>
								  </td>
								  <td width="25" style="text-align: center;"><?php echo $value->SEMESTER;?></td>
								  <td width="250" >
										<div class= "text-center span12 btn-icon-pg">
											<a class="btn btn-primary btn-mini" href="<?php echo base_url()?>absen/print_absen/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><i class="icon-print"></i> Absensi Mahasiswa</a>
											<a class="btn btn-primary btn-mini" href="<?php echo base_url()?>absen/brt_acara/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><i class="icon-print"></i> Berita Acara</a>
										</div>
								  </td>
								  <td>
									  <div class="buttons text-center"> <a id="edit-absen" data-toggle="modal" href="#modal-edit-absen" class="btn btn-danger btn-mini"><i class="icon-edit icon-white"></i> Edit</a>
									  <div class="modal hide" id="modal-edit-absen">
										<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">×</button>
										<h3>Edit Data Absensi</h3>
										</div>
											<div class="modal-body">
											<p>Nama Mata Kuliah:</p>
											<p>
												<input id="event-name" type="text" value="<?php echo $value->IDMAKUL;?>" disabled />
											</p>
											</div>
											<div class="modal-body">
											<p>Program Studi:</p>
											<p>
												<input id="event-name" type="text" />
											</p>
											</div>
											<div class="modal-body">
											<p>Kelas</p>
											<p>
												<input id="event-name" type="text" />
											</p>
											</div>
											<div class="modal-body">
											<p>Semester:</p>
											<p>
												<input id="event-name" type="text" />
											</p>
											</div>
										<div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Cancel</a> <a href="#" id="add-event-submit" class="btn btn-primary">Add event</a> </div>
									</div>
									</div></td>
								</tr><?php
								$no++;
							}?>
							</tbody>
						</table>
					</div><?php
					}?>
				</div>
				<?php /*
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>DATA RIWAYAT MENGAJAR</h5>
					</div>
					<div class="widget-content">
						<div class="todo">
							<ul><?php
								if(isset($data_mk)){
									foreach($data_mk as $value){
										$thn_ajr = substr($value->THSHM, 0, -1);
										$smt = substr($value->THSHM, -1);
										if($smt % 2 != 0){
											$smt_show = "GANJIL";
										}else{
											$smt_show = "GENAP";
										}?>
										<li class="clearfix">
											<a href="<?php echo base_url();?>makul/view/<?php echo $value->THSHM;?>">
												<div class="txt">TAHUN AJARAN <?php echo $smt_show," ".$thn_ajr; ?> <span class="date badge badge-info"><?php echo $value->jlh; ?> course</span></div>
												<div class="pull-right"> <a class="tip" href="<?php echo base_url();?>makul/view/<?php echo $value->THSHM;?>" title="Lihat"><i class="icon-eye-open"></i></a></div>
											</a>
										</li><?php
									}?><?php
								}
								echo $this->session->flashdata("msg");?>
								<li>
									<a href="<?php echo base_url();?>home/sinkronisasi"><button class="btn btn-info btn-mini">Sinkronisasi >></button></a>
								</li>
							</ul>
						</div>
					</div>*/?>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end-main-container-part-->
