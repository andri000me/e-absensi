<div class="page-wrapper">
   <!-- ============================================================== -->
   <!-- Bread crumb and right sidebar toggle -->
   <!-- ============================================================== -->
   <div class="page-breadcrumb">
      <div class="row">
         <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">RIWAYAT MENGAJAR</h4>
            <div class="ml-auto text-right">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item active"><a href="<?php base_url(); ?>home">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Riwayat mengajar</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </div>
   <!-- End bread crumb -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <?php if(isset($data_mk)): ?>
               <div class="card-body">
                  <h5 class="card-title">DATA RIWAYAT MENGJAR</h5>
                  <div class="table-responsive">
                     <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="text">
                           <tr>
                              <th>Kurikulum</th>
                              <th>Jumlah Makul</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data_mk as $value): 
                        $thn_ajr = substr($value->THSHM, 0, -1);
								$smt = substr($value->THSHM, -1);
								if($smt % 2 != 0){
									$smt_show = "GANJIL";
								}else{
									$smt_show = "GENAP";
                        }?>
                           <tr>
                              <td>
                                 <a href="<?php echo base_url();?>makul/view/<?php echo $value->THSHM;?>">
                                    <b>TAHUN AJARAN
                                    <?php echo $smt_show," ".$thn_ajr; ?>
                                    </b>
                                 </a>
                              </td>
                              <td><span class="badge badge-primary">
                                    <?php echo $value->jlh; ?> <b>mata kuliah </b></span></td>
                           </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>

</div>