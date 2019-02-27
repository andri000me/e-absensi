<!--main-container-part-->
<div id="content">
	<!--breadcrumbs-->
	  <div id="content-header">
		<div id="breadcrumb">
			<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a href="<?php echo base_url();?>home/dataajar" class="current">Riwayat Mengajar</a>
		</div>
	  </div>
	<!--End-breadcrumbs-->

	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>DATA RIWAYAT MENGAJAR</h5>
					</div>
					<div class="widget-content nopadding"><?php
					if(isset($data_mk)){?>
						<table class="table table-bordered data-table">
							<thead>
								<tr>
								  <th>Kurikulum</th>
								  <th>Jumlah Makul</th>
								</tr>
							</thead><?php
							foreach($data_mk as $value){
								$thn_ajr = substr($value->THSHM, 0, -1);
								$smt = substr($value->THSHM, -1);
								if($smt % 2 != 0){
									$smt_show = "GANJIL";
								}else{
									$smt_show = "GENAP";
								}?>
								<tbody>
									<tr class="gradeA">
										<td>
											<a href="<?php echo base_url();?>makul/view/<?php echo $value->THSHM;?>">
												TAHUN AJARAN <?php echo $smt_show," ".$thn_ajr; ?>
											</a>
										</td>
									  <td><span class="date badge badge-info"><?php echo $value->jlh; ?> mata kuliah</span></td>
									</tr>
								</tbody><?php
							}?>
						</table><?php
					}?>
					<a href="<?php echo base_url();?>home/sinkronisasi">
						<button class="btn btn-info btn-mini">Sinkronisasi >></button>
					</a>
					</div>
				</div><?php
					echo $this->session->flashdata("msg");?>
			</div>
		</div>
	</div>
</div>
<!--end-main-container-part-->