<!--main-container-part-->
<div id="content">
	<!--breadcrumbs-->
	<div id="content-header">
		<div id="breadcrumb">
			<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a href="<?php echo base_url();?>makul/terkini" class="current"><?php if(isset($thnAjar)){ echo $thnAjar; }?></a>
		</div>
	</div>
	<!--End-breadcrumbs-->

	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>DATA AJAR <?php if(isset($thnAjar)){ echo $thnAjar; }?></h5>
					</div>
					<div class="widget-content <?php if(isset($thnAjar)){ ?>nopadding<?php }?>"><?php
						if(isset($data_mk)){?>
							<table class="table table-bordered table-striped">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>ID Makul</th>
								  <th>Nama Makul</th>
								  <th>Program Studi</th>
								  <th>Kls/SMT</th>
								</tr>
							  </thead>
							  <tbody><?php
								$no=1;
								foreach($data_mk as $value){?>
									<tr class="odd gradeX">
									  <td width="25"><?php echo $no;?></td>
									  <td width="70"><?php echo $value->IDMAKUL;?></td>
									  <td>
										<a href="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b><?php echo $value->NAMAMK;?></b></a>
									  </td>
									  <td width="350"><?php echo $value->NMPSTMSPST;?></td>
									  <td width="25"><?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?></td>
									</tr><?php
									$no++;
								}?>
							  </tbody>
							</table><?php
						}else{?>
							Silahkan Sinkronisasi Mata Kuliah yang anda Ajar terlebih dahulu melalui link <b>Sinkronisasi.</b><br/>
							<a href="<?php echo base_url();?>home/sinkronisasi">
								<button class="btn btn-info btn-mini">Sinkronisasi >></button>
							</a><?php
						}?>
					</div>
				</div>
			</div>      
		</div>
	</div>
</div>
<!--end-main-container-part-->