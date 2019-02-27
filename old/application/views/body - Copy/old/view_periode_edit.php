<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Edit Periode</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");
			foreach($CekPeriode as $data){?>
			<h4 id="forms-example" class="">Edit Periode</h4><hr/>
			<form class="form-horizontal" action="<?php echo base_url();?>periode/update" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="nama_periode">Nama Periode *</label>
					<div class="col-sm-7">
						<input type="hidden" class="form-control" name="id_periode" id="id_periode" value="<?php echo $data->id_periode;?>" required>
						<input type="text" class="form-control" name="nama_periode" id="nama_periode" placeholder="Nama Periode" value="<?php echo $data->nama_periode;?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="status_periode">Status *</label>
					<div class="col-sm-4"><?php 
						echo form_dropdown('status_periode',$list_periode, $data->status_periode, 'class="form-control" required="required"');?>
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
