<!--main-container-part-->
<div id="content">
	<!--breadcrumbs-->
	<div id="content-header">
		<div id="breadcrumb">
			<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
			<a href="<?php echo base_url();?>makul/terkini" class="current"><?php echo $thnAjar;?></a>
		</div>
	</div>
	<!--End-breadcrumbs-->

	<!--Action boxes-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
						<h5>DATA AJAR <?php echo $thnAjar;?></h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
						  <thead>
							<tr>
							  <th>ID Makul</th>
							  <th>Nama Makul</th>
							  <th>Program Studi</th>
							  <th>Kls/SMT</th>
							</tr>
						  </thead>
						  <tbody><?php
							if(isset($data_mk)){
								foreach($data_mk as $value){?>
									<tr class="odd gradeX">
									  <td><?php echo $value->IDMAKUL;?></td>
									  <td>
										<a href="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b><?php echo $value->NAMAMK;?></b></a>
									  </td>
									  <td><?php echo $value->NMPSTMSPST;?></td>
									  <td><?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?></td>
									</tr><?php
								}
							}?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>      
		</div>
	</div>
</div>
<!--end-main-container-part-->