<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Edit DIKUM</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");
			foreach($CekDikum as $data){?>
			<h4 id="forms-example" class="">Edit Dikum</h4><hr/>
			<form class="form-horizontal" action="<?php echo base_url();?>dikum/update" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="nama_dikum">Nama DIKUM *</label>
					<div class="col-sm-7">
						<input type="hidden" class="form-control" name="id_dikum" id="id_dikum" value="<?php echo $data->id_dikum;?>" required>
						<input type="text" class="form-control" name="nama_dikum" id="nama_dikum" placeholder="Nama DIKUM" value="<?php echo $data->nama_dikum;?>" required>
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
