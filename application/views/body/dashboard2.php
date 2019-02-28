<div class="page-wrapper">
   <!-- ============================================================== -->
   <!-- Bread crumb and right sidebar toggle -->
   <!-- ============================================================== -->
   <div class="page-breadcrumb">
      <div class="row">
         <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="ml-auto text-right">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item active"><a href="<?php base_url(); ?>home">Home</a></li>
                     <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
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
                  <h2 class="card-title">Selamat Datang :
                     <?php echo $this->session->userdata('nama');?>
                  </h2>
                  <p>Selamat datang diaplikasi E-ABSENSI Universitas UBudiyah Indonesia. Jika data bahan ajar terbaru
                     belum tampil, silahkan Sinkronisasi Mata Kuliah yang anda Ajar terlebih dahulu melalui link <b>Sinkronisasi</b>
                     dibawah. Aplikasi ini masih dalam tahap pengembangan, jika menemukan masalah/kendala silahkan
                     hubungi kami (ICT UUI). Email dcdc[at]uui.ac.id. Terimakasih.</p>
                  <a href="<?php echo base_url();?>home/sinkronisasi">
                     <button class="btn btn-info btn-mini">Sinkronisasi >></button>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- </div> -->

      <!-- <div class="container-fluid"> -->
      <div class="row">
         <div class="col-12">
            <div class="card">
               <?php
               if(isset($data_mkterkini)):?>
               <div class="card-body">
                  <h5 class="card-title">DATA AJAR TERKINI (<?php echo $thnAjar;?>)</h5>
                  <div class="table-responsive">
                     <table id="tb_dashboard2" class="table table-striped table-bordered">
                        <thead class="text">
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
                           <?php
                        $no=1;
                        foreach($data_mkterkini as $value): ?>
                           <tr>
                              <td>
                                 <?php echo $no;?>
                              </td>
                              <td>
                                 <?php echo $value->IDMAKUL;?>
                              </td>
                              <td>
                                 <a href="<?php echo base_url();?>makul/detail/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>"><b>
                                       <?php echo $value->NAMAMK;?></b></a>
                              </td>
                              <td>
                                 <?php echo $value->NMPSTMSPST;?>
                              </td>
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
                              <td>
                                 <?php echo $value->smt;?>
                              </td>
                           </tr>
                           <?php $no++;
                        endforeach; ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>No</th>
                              <th>ID Makul</th>
                              <th>Nama Makul</th>
                              <th>Program Studi</th>
                              <th>Kelas</th>
                              <th>Semester</th>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>