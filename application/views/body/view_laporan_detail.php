<div id="content"><?php
if(isset($data_mk)){
	foreach($data_mk as $value);?>
	<div id="content-header">
	  <div id="breadcrumb">
		<a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url();?>makul/view/<?php echo $thnAjarInt;?>" class="tip-bottom"><?php echo $thnAjar;?></a>
		<?php
		if($this->input->get('pertemuan')){?>
			<a href="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>" class="tip-bottom"><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></a>
			<?php
			if($this->input->get('act') && $this->input->get('act') == "absendos"){?>
				<a href="<?php echo current_url().'?pertemuan='.trim($this->security->xss_clean($this->input->get('pertemuan')));?>">Pertemuan <?php echo trim($this->security->xss_clean($this->input->get('pertemuan')));?> </a>
				<a href="<?php echo current_url().'?pertemuan='.trim($this->security->xss_clean($this->input->get('pertemuan')));?>&act=absendos" class="current">Berita Acara</a>
				<?php
			}else{?>
				<a href="<?php echo current_url().'?pertemuan='.trim($this->security->xss_clean($this->input->get('pertemuan')));?>" class="current">Pertemuan <?php echo trim($this->security->xss_clean($this->input->get('pertemuan')));?> </a>
				<?php
			}
		}else{?>
			<a href="<?php echo current_url();?>" class="tip-bottom"><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></a><?php
		}?>
	  </div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
				  <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
					<h5><?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?></h5>
				  </div>
			 <div class="widget-content">
         <div class="widget-box">
 				  <div class="widget-title"> <span class="icon"> <i class="icon-ok"></i> </span>
 					<h5>LAPORAN BERITA ACARA</h5>
 				  </div>
         <table class="table table-bordered table-striped table-hover">
           <?php
           if(isset($GetAbsenDos)){
           	foreach($GetAbsenDos as $value);?>
           <thead>
             <th>No.</th>
             <th>PERTEMUAN</th>
             <th>Tanggal</th>
             <th>JAM MASUK</th>
             <th>JAM KELUAR</th>
             <th>PEMBAHASAN</th>
             <th>METODE MENGAJAR</th>
             <th>TUGAS</th>
             <th>Mahasiswa Hadir</th>
             <th>Mahasiswa Tidak Hadir</th>
             <th>Action</th>
           </thead>
           <tbody>
             <?php $no=1; ?>
             <td width="15"><?php echo $no; ?></td>
             <td><?php echo $value->IDMAKUL; ?></td>
             <td><?php echo $value->TGL; ?></td>
             <td><?php echo $value->JM; ?></td>
             <td><?php echo $value->JK; ?></td>
             <td><?php echo $value->MATERI; ?></td>
             <td><?php echo $value->METODE; ?></td>
             <td><?php echo $value->TUGAS; ?></td>
             <td><?php echo $value->JLHHADIR; ?></td>
             <td><?php echo $value->JLHABSEN; ?></td>
             <td>
               <button type="button" class="btn btn-primary">Print</button>
               <button type="button" class="btn btn-basic" disabled>Edit</button>
             </td>
             <?php $no++; ?>
           </tbody>
         <?php } ?>
         </table>
			 </div>
			</div>
		</div>
	</div><?php
}?>
</div>
