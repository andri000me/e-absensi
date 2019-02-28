<div class="page-wrapper">
   <!-- ============================================================== -->
   <!-- Bread crumb and right sidebar toggle -->
   <!-- ============================================================== -->
   <div class="page-breadcrumb">
      <div class="row">
         <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Form Edit</h4>
            <div class="ml-auto text-right">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item active">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Cetak laporan</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Edit laporan</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </div>
   <?php foreach ($data_laporan as $lap): ?>
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <form class="form-horizontal" action="<?php echo base_url();?>absen/update_lap" method="post">
                  <div class="card-body">
                     <h4 class="card-title">Edit Laporan</h4>
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">IDMAKUL</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="fname" value="<?php echo $lap->IDMAKUL;?>"
                              disabled>
                           <input type="text" class="span11" name="idmakul" value="<?php echo $lap->IDMAKUL;?>" hidden />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mata Kuliah</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="fname" value="<?php echo $lap->NAMAMK;?>"
                              disabled>
                           <input type="text" class="span11" name="namamk" value="<?php echo $lap->NAMAMK;?>" hidden />
                        </div>
                     </div>
                     <div class="form-group row">
                        <!-- <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tahun Ajar</label> -->
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="fname" value="<?php echo $lap->THSHM;?>"
                              disabled hidden />
                           <input type="text" class="span11" name="thnajar" value="<?php echo $lap->THSHM;?>" hidden />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">KELAS</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="fname" value="<?php echo $lap->NAMAKLS;?>"
                              disabled>
                           <input type="text" class="span11" name="kelas" value="<?php echo $lap->NAMAKLS;?>" hidden />
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-9">                           
                           <input type="text" class="span11" name="idprodi" value="<?php echo $lap->IDPRODI;?>" hidden />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">SEMESTER</label>
                        <div class="col-sm-9">
                           <input type="number" class="form-control" id="fname" name="smt" value="<?php echo $lap->smt;?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="border-top">
                     <div class="card-body">
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <?php endforeach; ?>





</div>