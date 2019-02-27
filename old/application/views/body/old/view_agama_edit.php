<!--banner-->	
<div class="banner">
	<h2><a href="./">Home</a><i class="fa fa-angle-right"></i><span>Edit Agama</span></h2>
</div>
<!--//banner-->
<div class="blank">
	<div class="blank-page">
		<div class="grid-form1">
			<?php echo $this->session->flashdata("msg");
			foreach($CekAgama as $data){?>
			<h4 id="forms-example" class="">Edit Agama</h4><hr/>
			<form class="form-horizontal" action="<?php echo base_url();?>agama/update" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label hor-form" for="nama_Agama">Nama Agama *</label>
					<div class="col-sm-7">
						<input type="hidden" class="form-control" name="id_agama" id="id_agama" value="<?php echo $data->id_agama;?>" required>
						<input type="text" class="form-control" name="nama_agama" id="nama_agama" placeholder="Nama Agama" value="<?php echo $data->nama_agama;?>" required>
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
