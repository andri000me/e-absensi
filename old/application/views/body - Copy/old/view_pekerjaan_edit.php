<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Edit Pekerjaan</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");
			foreach($CekPekerjaan as $data){?>
			<h4 id="forms-example" class="">Edit Pekerjaan</h4><hr/>
			<form class="form-horizontal" action="<?php echo base_url();?>pekerjaan/update" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="nama_job">Nama Pekerjaan *</label>
					<div class="col-sm-7">
						<input type="hidden" class="form-control" name="id_job" id="id_job" value="<?php echo $data->id_job;?>" required>
						<input type="text" class="form-control" name="nama_job" id="nama_job" placeholder="Nama Pekerjaan" value="<?php echo $data->nama_job;?>" required>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn-primary btn">Update</button>
							<button class="btn-inverse btn">Reset</button>
						</div>
					</div>
				</div>
			</form><?php
			}?>
		</div>
	</div>
</div>
