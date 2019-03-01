<div class="page-wrapper">
   <!-- ============================================================== -->
   <!-- Bread crumb and right sidebar toggle -->
   <!-- ============================================================== -->
   <div class="page-breadcrumb">
      <div class="row">
         <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Riwayat Mengajar</h4>
            <div class="ml-auto text-right">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item active"><a href="<?php base_url(); ?>home">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page"> Riwayat mengajar </li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </div>

   <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Riwayat Mengajar
                     <?php echo $thnAjar;?>
                  </h5>
                  <div class="table-responsive">
                     <table id="tb_rwajar" class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>ID Makul</th>
                              <th>Nama Makul</th>
                              <th>Program Studi</th>
                              <th>Kelas</th>
                              <th>Semester</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($data_mk)): 
                              $no=1;
                              foreach($data_mk as $value):
                              ?>
                           <tr>
                              <td><?= $no; ?></td>
                              <td><?= $value->IDMAKUL; ?></td>
                              <td><a href="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b><?php echo $value->NAMAMK;?></b></a></td>
                              <td><?= $value->NMPSTMSPST; ?></td>
                              <td>
                              <?php
											if ($value->NAMAKLS == 01) {
												$kelas = "A";
											} elseif ($value->NAMAKLS == 02) {
												$kelas = "B";
											}else {
												$kelas = "NR";
                                 }
                                 echo $kelas;
											?>
                              </td>
                              <td><?php echo $value->smt;?></td>
                           </tr>

                           <?php 
                           $no++;
                              endforeach;
                              endif; ?>
                        </tbody>
                     </table>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>


</div>