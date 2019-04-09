<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('template/material-kit-master') ?>/assets/img/apple-icon.png">
   <link rel="icon" type="image/png" href="<?= base_url('template/material-kit-master') ?>/assets/img/favicon.png">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <title>
      E-ABSENSI | UUI
   </title>
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
   <!--     Fonts and icons     -->
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
   <!-- CSS Files -->
   <link href="<?= base_url('template/material-kit-master'); ?>/assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
   <!-- CSS Just for demo purpose, don't include it in your project -->
   <link href="<?= base_url('template/material-kit-master'); ?>/assets/demo/demo.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
</head>

<body class="index-page sidebar-collapse">
   <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
      <div class="container">
         <div class="navbar-translate">
            <a class="navbar-brand" href="<?= base_url(); ?>">
               Absensi Online | UUI </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
               <span class="sr-only">Toggle navigation</span>
               <span class="navbar-toggler-icon"></span>
               <span class="navbar-toggler-icon"></span>
               <span class="navbar-toggler-icon"></span>
            </button>
         </div>
         <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
               <li class="dropdown nav-item">
                  <a href="https://elearning.uui.ac.id" class="nav-link" data-toggle="dropdown">
                     <i class="material-icons">apps</i> Elearning
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="https://www.elearning.uui.ac.id/ubontv">
                     <i class="material-icons">tv</i> UB OnTV
                  </a>
               </li>            
            </ul>
         </div>
      </div>
   </nav>
   <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/bg2.jpg');">
      <div class="container">
         <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
               <div class="brand">
                  <h1>Absensi Online | UUI</h1>
                  <h3>World Class Cyber University | Creative, Innovative, Enterpreneurship, Leadership</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="main main-raised">
      <div class="section section-basic">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-nav-tabs">
                     <div class="card-header card-header-primary">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                           <div class="nav-tabs-wrapper">
                              <ul class="nav nav-tabs" data-tabs="tabs">
                                 <li class="nav-item">
                                    <a class="nav-link active" href="#profile" data-toggle="tab">
                                       <i class="material-icons">face</i> Profile
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="card-body ">
                        <div class="tab-content text-center">
                           <div class="tab-pane active" id="profile">
                              <p> Selamat datang di aplikasi E-Absensi Universitas UBudiyah Indonesia. Terima kasih atas kunjungannya. </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php if (isset($GetListDos)) : ?>
            <hr>
            <div class="row">
               <div class="col-md-12">
                  <h3 class="text-center">
                     <small>Daftar Dosen Pengajar</small>
                  </h3>
               </div>
            </div>
            <div class="row">
               <?php foreach($GetListDos as $value) : ?>
               <div class="col-lg-4">
                  <div class="card text-center">
                     <img src="<?= base_url('img/'.$value->PICTURE) ?>" class="card-img-top">
                     <div class="card-body">
                        <h5 class="card-title"><?php echo $value->NAMADOS;?></h5>
                        <p class="card-text"> Program Studi : <?php echo $value->NAMAPRODIDOS;?></p>
                        <p class="card-text"> Bidang : <?php echo $value->KEAHLIAN;?></p>
                        <a href="<?php echo base_url();?>publik/dosen/<?php echo $value->IDDOSEN;?>" class="btn btn-primary">Pilih Mata Kuliah</a>
                     </div>
                  </div>
               </div>
               <?php endforeach; ?>
            </div>
            <?php endif ?>
            <hr>
            <?php if(isset($GetDetailDos)){?>
            <div class="container">
  				   <div class="col-"> 
                    <?php
                    foreach($GetDetailDos as $valuedos)?>
                    <div class="card mb-3">
                     <div class="row no-gutters">
                        <div class="col-md-2">
                           <img src="<?= base_url('img/'.$valuedos->PICTURE) ?>" class="card-img" style="height:250px; width:180px">
                        </div>
                        <div class="col-md-10">
                           <div class="card-body">
                           <p class="card-title h3"><?= $valuedos->NAMADOS ?></p><hr>
                           <p class="card-text h5">PROGRAM STUDI : <?= $valuedos->NAMAPRODIDOS ?></p>
                           <p class="card-text">Bidang : <?= $valuedos->KEAHLIAN ?></p>
                           <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                  if($this->uri->segment(4) && $this->uri->segment(5) && $this->uri->segment(6) && $this->uri->segment(7) && $this->uri->segment(8)){
                     $THSHM = trim($this->security->xss_clean($this->uri->segment(5)));
                     $IDPRODI = trim($this->security->xss_clean($this->uri->segment(6)));
                     $IDMAKUL = trim($this->security->xss_clean($this->uri->segment(4)));
                     $NAMAKLS = trim($this->security->xss_clean($this->uri->segment(7)));
                     $SEMESTER = trim($this->security->xss_clean($this->uri->segment(8)));
                     $kirim = $this->my_model->fetchUrl(base_url().'publik/getmateri?IDDOSEN='.$valuedos->IDDOSEN .'&IDMAKUL='.$IDMAKUL .'&KELAS='.$NAMAKLS .'&THNSM='. $THSHM .'&IDPRODI='. $IDPRODI .'&SEMESTER='. $SEMESTER);
                     $respon = json_decode($kirim, true);?>
  							<div class="table-responsive-sm"><?php
  								foreach($data_mk_detail as $detailMK);?>
  								<h4 class="mb-3">Detail MK : <?php echo $detailMK->IDMAKUL ." - ".$detailMK->NAMAMK;?></h4><hr><?php
  								if(!isset($respon['status'])){?>
  									<table class="table">
  										<thead>
  											<tr>
  												<th>#</th>
  												<th>MATERI AJAR</th>
  												<th>PERTEMUAN</th>
  											</tr>
  										</thead>
  										<tbody><?php
  											$no=1;
  											foreach($respon as $data => $value1){
  												if($value1['SIFAT'] == 0){?>
  													<tr>
  														<td width="25"><?php echo $no;?></td>
  														<td><?php echo $value1['JUDUL'];?> (private)</td>
  														<td><?php echo $value1['PERTEMUAN'];?></td>
  													</tr><?php
  												}else{?>
  													<tr>
  														<td><?php echo $no;?></td>
  														<td>
  															<a href="<?php echo base_url();?>publik/download/<?php echo $value1['NAMA_FILE'];?>" title="Download"><b><?php echo $value1['JUDUL'];?></b></a> (publik)
  														</td>
  														<td><?php echo $value1['PERTEMUAN'];?></td>
  													<tr/><?php
  												}
  												$no++;
  											}?>
  										</tbody>
  									</table><?php
                          }else{?>
                           <div class="row mt-3">
                              <div class="col-md-">
                              <!-- Tabs with icons on Card -->
                                 <div class="card card-nav-tabs">
                                    <div class="card-header card-header-danger">
                                       <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                       <div class="nav-tabs-navigation">
                                       <div class="nav-tabs-wrapper">
                                          <ul class="nav nav-tabs" data-tabs="tabs">
                                             <li class="nav-item active">
                                             <a class="nav-link" href="#Profile" data-toggle="tab">
                                                <i class="material-icons">face</i> Jumlah Pertemuan
                                             </a>
                                             </li>
                                             <li class="nav-item">
                                             <a class="nav-link" href="#settings" data-toggle="tab">
                                                <i class="material-icons">build</i> Statistik
                                             </a>
                                             </li>
                                          </ul>
                                       </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="tab-content text-center">
                                          <div class="tab-pane active" id="Profile">
                                             <p> Jumlah Pertemuan pada Matakuliah ini adalah sebanyak: <span class="badge badge-pill badge-rose"> <?php error_reporting(0); echo $jmlpertemuan ;?> Pertemuan </span></p>
                                             <p>Jumlah mahasiswa yang mengikuti matakuliah ini sebanyak: <span class="badge badge-pill badge-rose"> <?php print_r(count($jmlmhsw));?> Mahasiswa</span></p>
                                             <hr>
                                             <table class="table">
                                                <thead class="thead-dark">
                                                <tr>
                                                   <th rowspan="2" width="3%"><center>No</center></th>
                                                   <th rowspan="2"><center>NIM</center></th>
                                                   <th rowspan="2"><center>Nama Mahasiswa</center></th>
                                                   <th colspan="16"><center>Kehadiran Mahasiswa</th>
                                                   <th rowspan="2" width="10%"><center>Jumlah Hadir</th>
                                                   <th rowspan="2" width="10%"><center>Persentase Hadir</th>
                                                </tr>
                                                <?php
                                                for($pertemuan=1; $pertemuan <= 16; $pertemuan++){
                                                   echo "<th><center>$pertemuan</th>";
                                                }
                                                   ?>
                                                </thead>
                                                <tbody>
                                                <?php
                                                   $IDMAKUL = trim($this->security->xss_clean($this->uri->segment(4)));
                                                   if(isset($absen_mhsw)){
                                                      $no=1;
                                                      foreach($absen_mhsw as $value){?>
                                                         <tr class="odd gradeX">
                                                         <td><center><?php echo $no;?></td>
                                                         <td><?php echo $value->IDMAHASISWA;?></td>
                                                         <td>
                                                            <?php echo $value->NAMAMHS;?>
                                                         </td>
                                                         <!-- tabel data absen-->
                                                         <?php
                                                         for($absen=1; $absen <= 16; $absen++){
                                                            $key_arr = $value->IDMAHASISWA.'_'.$absen;
                                                            if(array_key_exists($key_arr, $list_absen)) {
                                                               echo "<td><center>$list_absen[$key_arr]</td>";
                                                            }else{
                                                               echo "<td><center>-</td>";
                                                            }
                                                         }

                                                         // hitung jumlah kehadiran
                                                         $this->db->from('absen_mhs');
                                                         $this->db->like("ABSENSI", "H");
                                                         $this->db->where('IDMAHASISWA', $value->IDMAHASISWA);
                                                         $this->db->where('IDMAKUL', $IDMAKUL);
                                                         $this->db->where('IDPRODI', $value->IDPRODI);
                                                         
                                                         $jmlhhadir = $this->db->count_all_results();
                                                         $pershdr = ($jmlhhadir/16) * 100;

                                                            // $data['jmlhdr1'] = $jmlhhadir;
                                                            ?>
                                                         <td width="50" style="text-align: center;"><?php echo $jmlhhadir; ?></td>
                                                         <td width="50" style="text-align: center;"><?php  echo $pershdr; ?> %</td>
                                                         <!--<td width="50" style="text-align: center;"></td>-->
                                                         <!--<td width="50" style="text-align: center;"></td>-->
                                                         </tr><?php
                                                         $no++;
                                                      }
                                                   }?>
                                                </tbody>
                                             </table>
                                          </div>
                                          <div class="tab-pane" id="settings">
                                             <p class="h5">Statistik Perkuliahan Kehadiran, Ketidakhadiran, Sakit dan Izin</p>
                                             <hr>
                                             <div class="col-">
                                                <div id="piekehadiran" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                                                <h3 class="text-center margin-bottom-5">Universitas Ubudiyah Indonesia</h3>
                                                <p class="text-center">Creative, Innovative, entrepreneurship, leadership</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- segmen show absensi -->
  							<?php	}?>
  							</div><?php
  						}else{?>
  							<div class="table-responsive-sm">
  								<h4>Riwayat Mengajar Terkini (<?php echo $thnAjar;?>)</h4><?php
  								if(isset($data_mk)){?>
  									<table class="table">
  										<thead>
  											<tr>
  												<th>#</th>
  												<th>Nama Mata Kuliah</th>
  												<th class="text-center">Kelas</th>
                                    <th class="text-center">Program Studi</th>
                                    <th class="text-center">SEMESTER</th>
  												<!-- <th>Jumlah Pertemuan</th> -->
  											</tr>
  										</thead>
  										<tbody><?php
  										$no=1;
  										foreach($data_mk as $value){?>
  											<tr>
  												<td width="25"><?php echo $no;?></td>
  												<td>
  													<a href="<?php echo base_url();?>publik/dosen/<?php echo $valuedos->IDDOSEN;?>/<?php echo $value->IDMAKUL;?>/<?php echo $value->THSHM;?>/<?php echo $value->IDPRODI;?>/<?php echo $value->NAMAKLS;?>/<?php echo $value->SEMESTER;?>">
  													<?php echo $value->IDMAKUL;?> - <?php echo $value->NAMAMK;?>
  													</a>
  												</td>
                          <?php
                          if ($value->NAMAKLS == 01) {
                            $kelas = "A";
                          } elseif ($value->NAMAKLS == 02) {
                            $kelas = "B";
                          }else {
                            $kelas = "NR";
                          }
                           ?>
                           <td class="text-center"><?php echo $kelas;?></td>
                          <td class="text-center"><?php echo $value->NMPSTMSPST; ?>	</td>
                          <td class="text-center"><?php echo $value->smt; ?>	</td>
  											</tr><?php
  											$no++;
  										}?>
  									  </tbody>
  									</table><?php
  								}?>
  							</div><?php
  						}?>
  					</div>
  				</div><?php
  			}?>

         </div>
      </div>
   </div>


   <footer class="footer footer-default">
        <div class="container">
            <nav class="float-left">
                <ul>
                    <li>
                        <a href="https://www.creative-tim.com/">
                            Ict Universitas Ubudiyah Indonesia
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright float-right">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>, made with <i class="material-icons">favorite</i> by
                <a href="#" target="blank">DCDC-Team</a>
            </div>
        </div>
    </footer>

   <script src="<?= base_url('template/material-kit-master') ?>/assets/js/core/jquery.min.js" type="text/javascript"></script>
   <script src="<?= base_url('template/material-kit-master') ?>/assets/js/core/popper.min.js" type="text/javascript"></script>
   <script src="<?= base_url('template/material-kit-master') ?>/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
   <script src="<?= base_url('template/material-kit-master') ?>/assets/js/plugins/moment.min.js"></script>
   <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
   <script src="<?= base_url('template/material-kit-master') ?>/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
   <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
   <script src="<?= base_url('template/material-kit-master') ?>/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
   <!--  Google Maps Plugin    -->
   <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
   <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
   <script src="<?= base_url('template/material-kit-master') ?>/assets/js/material-kit.js?v=2.0.5" type="text/javascript"></script>
   <script src="<?php echo base_url();?>template/highchart/highcharts.js"></script>
   <script src="<?php echo base_url();?>template/highchart/exporting.js"></script>
   <script src="<?php echo base_url();?>template/highchart/export-data.js"></script>
   <script>
      $(document).ready(function() {
         //init DateTimePickers
         materialKit.initFormExtendedDatetimepickers();

         // Sliders Init
         materialKit.initSliders();
      });


      function scrollToDownload() {
         if ($('.section-download').length != 0) {
            $("html, body").animate({
               scrollTop: $('.section-download').offset().top
            }, 1000);
         }
      }
   </script>
   <script>
       Highcharts.chart('piekehadiran', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Pembagian persentase kehadiran'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Persetase',
            colorByPoint: true,
            data: [{
                name: 'Kehadiran',
                y: <?php
                if($hadirH >= 1){
                  echo $hadirH;
                }else{
                  echo 0;
                }
                ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Alpha',
                y: <?php
                if($hadirA >= 1){
                  echo $hadirA;
                }else{
                  echo 0;
                }
                ?>
            }, {
                name: 'Sakit',
                y: <?php
                if($hadirS >= 1){
                  echo $hadirS;
                }else{
                  echo 0;
                }
                ?>
            }, {
                name: 'Izin',
                y: <?php
                if($hadirI >= 1){
                  echo $hadirI;
                }else{
                  echo 0;
                }
                ?>
            }]
        }]
    });
   </script>
</body>

</html>