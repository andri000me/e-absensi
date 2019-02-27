<!--main-container-part-->
<div id="content">
	<!--breadcrumbs-->
	  <div id="content-header">
		<div id="breadcrumb"> <a href="<?php echo base_url();?>home" title="Go to Home" class="current"><i class="icon-home"></i> Home</a></div>
	  </div>
	<!--End-breadcrumbs-->

	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-content">
						<h4>Selamat Datang : <?php echo $this->session->userdata('nama');?></h4>
						<p>Selamat datang diaplikasi E-ABSENSI Universitas UBudiyah Indonesia. Jika data bahan ajar terbaru belum tampil, silahkan Sinkronisasi Mata Kuliah yang anda Ajar terlebih dahulu melalui link <b>Sinkronisasi</b> dibawah. Aplikasi ini masih dalam tahap pengembangan, jika menemukan masalah/kendala silahkan hubungi kami (ICT UUI). Email dcdc[at]uui.ac.id. Terimakasih.</p>
						<a href="<?php echo base_url();?>home/sinkronisasi">
							<button class="btn btn-info btn-mini">Sinkronisasi >></button>
						</a>
					</div>
				</div>
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
								  <th>Kelas</th>
								  <th>Semester</th>
								</tr>
							</thead>
							<tbody><?php
							$no=1;
							foreach($data_mkterkini as $value){?>
								<tr class="odd gradeX">
								  <td width="30" style="text-align: center;" ><?php echo $no;?></td>
								  <td width="70" style="text-align: center;"><?php echo $value->IDMAKUL;?></td>
								  <td>
									<a href="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b><?php echo $value->NAMAMK;?></b></a>
								  </td>
								  <td width="350"><?php echo $value->NMPSTMSPST;?></td>
									<td width="50" style="text-align: center;">
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
								  <!-- <td width="25" style="text-align: center;"><?php echo $kelas;?></td> -->
								  <td width="50" style="text-align: center;"><?php echo $value->SEMESTER;?></td>
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
