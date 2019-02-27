<!--main-container-part-->
<div id="content">
	<!--breadcrumbs-->
	<div id="content-header">
		<div id="breadcrumb">
			<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a href="<?php echo base_url();?>absen" class="current"><?php echo $thnAjar;?></a>
		</div>
	</div>
	<!--End-breadcrumbs-->

	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>MATA KULIAH <?php echo $thnAjar;?></h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th>No.</th>
							  <th>ID Makul</th>
							  <th>Nama Makul</th>
							  <th>Program Studi</th>
							  <th>Kls/SMT</th>
							</tr>
						  </thead>
						  <tbody><?php
							$no=1;
							if(isset($data_mk)){
								foreach($data_mk as $value){?>
									<tr class="odd gradeX">
									  <td><?php echo $no;?></td>
									  <td><?php echo $value->IDMAKUL;?></td>
									  <td>
										<a href="<?php echo base_url();?>absen/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b><?php echo $value->NAMAMK;?></b></a>
									  </td>
									  <td><?php echo $value->NMPSTMSPST;?></td>
									  <td><?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?></td>
									</tr><?php $no++;
								}
							}?>
						  </tbody>
						</table>
					</div>
					<br>
					<p><b>Catatan :</b>Pilih salah satu mata kuliah diatas!</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end-main-container-part-->
