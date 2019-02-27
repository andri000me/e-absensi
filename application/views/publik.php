<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-ABSENSI UUI</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!--
    Visual Admin Template
    http://www.templatemo.com/preview/templatemo_455_visual_admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url();?>template/adminvisual/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/adminvisual/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/adminvisual/css/templatemo-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>E-ABSENSI UUI</h1>
        </header>
        <div class="profile-photo-container">
          <img src="<?php echo base_url();?>template/adminvisual/images/eabsensi.jpg" alt="E-ABSENSI UUI" class="img-responsive">
          <div class="profile-photo-overlay"></div>
        </div>
        <!-- Search box -->
        <form class="templatemo-search-form" role="search">
          <div class="input-group">
              <button type="submit" class="fa fa-search"></button>
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
          </div>
        </form>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
      </div>
      <!-- Main content -->
      <div class="templatemo-content col-1 light-gray-bg">
          <div class="templatemo-top-nav-container">
            <div class="row">
              <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                  <li><a href="<?php echo base_url();?>" class="active">Beranda</a></li>
                  <!-- <li><a href="<?php echo base_url();?>">Statistik Perkuliahan</a></li> -->
                  <li><a href="<?php echo base_url();?>login">Login Dosen</a></li><?php /*
                  <li><a href="login.html">Sign in form</a></li>*/?>
                </ul>
              </nav>
            </div>
          </div>
          <div class="templatemo-content-container">
            <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
    					<div class="col-1 templatemo-overflow-hidden">
    					  <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
    						<i class="fa fa-times"></i>
    						<div class="templatemo-flex-row flex-content-row">
    						  <div class="col-1 col-lg-6 col-md-12">
    							<h2 class="templatemo-inline-block">E-ABSENSI</h2><hr>
    							<p>Selamat datang di aplikasi E-Absensi Universitas UBudiyah Indonesia. Terima kasih atas kunjungannya.</p>
    						  </div>
    						</div>
    					  </div>
    					</div>
    				</div>
            <?php
  			if(isset($GetListDos)){?>
  				<h2 class="margin-bottom-10">List Dosen Pengajar</h2>
  				<div class="panel panel-default table-responsive">
  					<table class="table table-striped table-bordered templatemo-user-table">
  						<thead>
  							<tr>
  								<td>#</td>
  								<td>Nama</td>
  								<td>Program Studi</a></td>
  								<td>Keahlian</td>
  							</tr>
  						</thead>
  						<tbody><?php
  							$no=1;
  							foreach($GetListDos as $value){?>
  								<tr>
  									<td><?php echo $no;?></td>
  									<td><a href="<?php echo base_url();?>publik/dosen/<?php echo $value->IDDOSEN;?>"><?php echo $value->NAMADOS;?></a></td>
  									<td><?php echo $value->NAMAPRODIDOS;?></td>
  									<td><?php echo $value->KEAHLIAN;?></td>
  								</tr><?php
  								$no++;
  							}?>
  						</tbody>
  					</table>
  				</div><?php
  			}
  			if(isset($GetDetailDos)){?>
  				<div class="templatemo-flex-row flex-content-row">
  					<div class="templatemo-content-widget white-bg col-2"><?php
  						foreach($GetDetailDos as $valuedos)?>
  						<div class="media margin-bottom-30">
  							<div class="media-left padding-right-25">
  							  <a href="#">
  								<img class="media-object img-circle templatemo-img-bordered" src="<?php echo base_url();?>img/<?php echo $valuedos->PICTURE;?>" alt="<?php echo $valuedos->NAMADOS;?>" width="64" height="64">
  							  </a>
  							</div>
  							<div class="media-body">
  							  <h2 class="media-heading text-uppercase blue-text"><?php echo $valuedos->NAMADOS;?></h2>
  							  <p><?php echo $valuedos->KEAHLIAN;?></p>
  							</div>
  						</div><?php
  						if($this->uri->segment(4) && $this->uri->segment(5) && $this->uri->segment(6) && $this->uri->segment(7) && $this->uri->segment(8)){
  							$THSHM = trim($this->security->xss_clean($this->uri->segment(5)));
  							$IDPRODI = trim($this->security->xss_clean($this->uri->segment(6)));
  							$IDMAKUL = trim($this->security->xss_clean($this->uri->segment(4)));
  							$NAMAKLS = trim($this->security->xss_clean($this->uri->segment(7)));
  							$SEMESTER = trim($this->security->xss_clean($this->uri->segment(8)));
  							$kirim = $this->my_model->fetchUrl(base_url().'publik/getmateri?IDDOSEN='.$valuedos->IDDOSEN .'&IDMAKUL='.$IDMAKUL .'&KELAS='.$NAMAKLS .'&THNSM='. $THSHM .'&IDPRODI='. $IDPRODI .'&SEMESTER='. $SEMESTER);
  							$respon = json_decode($kirim, true);?>
  							<div class="table-responsive"><?php
  								foreach($data_mk_detail as $detailMK);?>
  								<h4>Detail MK : <?php echo $detailMK->IDMAKUL ." - ".$detailMK->NAMAMK;?></h4><?php
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
  													</tr><?php
  												}
  												$no++;
  											}?>
  										</tbody>
  									</table><?php
  								}else{?>
                    <!-- <h3>Jumlah Pertemuan Pada Matakuliah ini : <?php error_reporting(0);  print_r(count($statusAbsen));?> Pertemuan</h3> -->
                    <div class="templatemo-flex-row flex-content-row">
                      <div class="col-1">
                        <div class="panel panel-default margin-10">
                          <div class="templatemo-content-widget blue-bg">
                            <h2 class="text-uppercase margin-bottom-10">Jumlah Pertemuan</h2>
                            <h4 class="text-uppercase margin-bottom-10">Jumlah Pertemuan terkini pada MataKuliah Ini Sebanyak <?php error_reporting(0);  print_r(count($jmlpertemuan));?></h4>
                          </div>
                          <div class="templatemo-content-widget green-bg">
                            <h2 class="text-uppercase margin-bottom-10">Jumlah Mahasiswa</h2>
                            <h4 class="margin-bottom-0">Jumlah Mahasiswa pada Mata Kuliah ini adalah <br> <?php error_reporting(0); print_r(count($jmlmhsw));?> Orang Mahasiswa</h4>
                          </div>
                        </div>
                      </div>
                      <div class="col-1">
                        <div class="panel panel-default border-10">
                          <div class="panel-heading border-radius-10">
                            <h2>Statistik Perkuliahan</h2> <p>Kehadiran, Ketidakhadiran, Sakit dan Izin</p>
                          </div>
                          <div class="panel-body">
                            <div class="templatemo-flex-row flex-content-row">
                              <div class="col-1">
                                <div id="piekehadiran" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                                <h3 class="text-center margin-bottom-5">Universitas Ubudiyah Indonesia</h3>
                                <p class="text-center">Creative, Innovative, entrepreneurship, leadership</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-1">
                      <div class="panel panel-default margin-10">
                        <div class="templatemo-content-widget no-padding">
                          <div class="panel panel-default table-responsive">
                            <table class="table table-striped table-bordered templatemo-user-table">
                              <thead>
                                <tr>
                                  <th rowspan="2" width="3%" class="text-center">No</th>
                                  <th rowspan="2" class="text-center">NIM</th>
                                  <!-- <th rowspan="2"><center>Nama Mahasiswa</center></th> -->
                                  <th colspan="16" class="text-center">Kehadiran Mahasiswa</th>
                                  <th rowspan="2" width="10%" class="text-center">Jumlah Hadir</th>
                                  <th rowspan="2" width="10%" class="text-center">Persentase Hadir</th>
                                </tr>
                                <?php
                                for($pertemuan=1; $pertemuan <= 16; $pertemuan++){
                                  echo "<td><center>$pertemuan</td>";
                                }
                                 ?>
                              </thead>

                              <tbody>
                                <?php
                                if(isset($absen_mhsw)){
                                  $no=1;
                                  foreach($absen_mhsw as $value){?>
                                    <tr class="odd gradeX">
                                      <td class="text-center"><?php echo $no;?></td>
                                      <td><?php echo $value->IDMAHASISWA;?></td>
                                      <!-- <td>
                                        <?php echo $value->NAMAMHS;?>
                                      </td> -->
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

                                      $this->db->like("ABSENSI", "H");
                                      $this->db->from('absen_mhs');
                                      $this->db->where('IDMAHASISWA', $value->IDMAHASISWA);
                                      $jmlhhadir = $this->db->count_all_results();
                                      $pershdr = ($jmlhhadir/16) * 100;

                                       // $data['jmlhdr1'] = $jmlhhadir;
                                       ?>
                                      <td width="50" style="text-align: center;"><?= $jmlhhadir; ?></td>
                                      <td width="50" style="text-align: center;"><?= $pershdr; ?> %</td>
                                    </tr><?php
                                    $no++;
                                  }
                                }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
  							<?php	}?>
  							</div><?php
  						}else{?>
  							<div class="table-responsive">
  								<h4>Riwayat Mengajar Terkini (<?php echo $thnAjar;?>)</h4><?php
  								if(isset($data_mk)){?>
  									<table class="table">
  										<thead>
  											<tr>
  												<th>#</th>
  												<th>Nama Mata Kuliah</th>
  												<th>Kelas</th>
                          <th>Program Studi</th>
                          <th>SEMESTER</th>
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
  												<td><?php echo $kelas;?></td>
                          <td><?php echo $value->NMPSTMSPST; ?>	</td>
                          <td><?php echo $value->SEMESTER; ?>	</td>
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


  			<footer class="text-right">
  				<p>Copyright &copy; <?php echo date("Y");?> Universitas Ubudiyah Indonesia
  				| This Apps Develop by <a href="https://www.uui.ac.id" target="_parent">ICT UUI</a></p>
  			</footer>
          </div>
        </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <!-- highcharts -->
    <script src="<?php echo base_url();?>template/highchart/highcharts.js"></script>
    <script src="<?php echo base_url();?>template/highchart/exporting.js"></script>
    <script src="<?php echo base_url();?>template/highchart/export-data.js"></script>
    
    <script>
    // pie kehadiran
    Highcharts.chart('piekehadiran', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Pembagian persentase kehadiran, 2018'
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

    //akhir pie kehadiran



      var gaugeChart;
      var gaugeData;
      var gaugeOptions;
      var timelineChart;
      var timelineDataTable;
      var timelineOptions;
      var areaData;
      var areaOptions;
      var areaChart;

      /* Gauage
      --------------------------------------------------*/
      google.load("visualization", "1", {packages:["gauge"]});
      google.setOnLoadCallback(drawGauge);
      google.load("visualization", "1", {packages:["timeline"]});
      google.setOnLoadCallback(drawTimeline);
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);

      $(document).ready(function(){
        if($.browser.mozilla) {
          //refresh page on browser resize
          // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
          $(window).bind('resize', function(e)
          {
            if (window.RT) clearTimeout(window.RT);
            window.RT = setTimeout(function()
            {
              this.location.reload(false); /* false to get page from cache */
            }, 200);
          });
        } else {
          $(window).resize(function(){
            drawCharts();
          });
        }
      });

      function drawGauge() {

        gaugeData = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', 80],
          ['CPU', 55],
          ['Network', 68]
        ]);

        gaugeOptions = {
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        gaugeChart = new google.visualization.Gauge(document.getElementById('gauge_div'));
        gaugeChart.draw(gaugeData, gaugeOptions);

        setInterval(function() {
          gaugeData.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          gaugeChart.draw(gaugeData, gaugeOptions);
        }, 13000);
        setInterval(function() {
          gaugeData.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          gaugeChart.draw(gaugeData, gaugeOptions);
        }, 5000);
        setInterval(function() {
          gaugeData.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          gaugeChart.draw(gaugeData, gaugeOptions);
        }, 26000);
      } // End function drawGauage

      /* Timeline
      --------------------------------------------------*/
      function drawTimeline() {
        var container = document.getElementById('timeline_div');
        timelineChart = new google.visualization.Timeline(container);
        timelineDataTable = new google.visualization.DataTable();
        timelineDataTable.addColumn({ type: 'string', id: 'Room' });
        timelineDataTable.addColumn({ type: 'string', id: 'Name' });
        timelineDataTable.addColumn({ type: 'date', id: 'Start' });
        timelineDataTable.addColumn({ type: 'date', id: 'End' });
        timelineDataTable.addRows([
          [ 'Magnolia Room',  'CSS Fundamentals',    new Date(0,0,0,12,0,0),  new Date(0,0,0,14,0,0) ],
          [ 'Magnolia Room',  'Intro JavaScript',    new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
          [ 'Magnolia Room',  'Advanced JavaScript', new Date(0,0,0,16,30,0), new Date(0,0,0,19,0,0) ],
          [ 'Gladiolus Room', 'Intermediate Perl',   new Date(0,0,0,12,30,0), new Date(0,0,0,14,0,0) ],
          [ 'Gladiolus Room', 'Advanced Perl',       new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
          [ 'Gladiolus Room', 'Applied Perl',        new Date(0,0,0,16,30,0), new Date(0,0,0,18,0,0) ],
          [ 'Petunia Room',   'Google Charts',       new Date(0,0,0,12,30,0), new Date(0,0,0,14,0,0) ],
          [ 'Petunia Room',   'Closure',             new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
          [ 'Petunia Room',   'App Engine',          new Date(0,0,0,16,30,0), new Date(0,0,0,18,30,0) ]]);

        timelineOptions = {
          timeline: { colorByRowLabel: true },
          backgroundColor: '#ffd'
        };

        timelineChart.draw(timelineDataTable, timelineOptions);
      } // End function drawTimeline

      function drawCharts () {
          gaugeChart.draw(gaugeData, gaugeOptions);
          timelineChart.draw(timelineDataTable, timelineOptions);
          areaChart.draw(areaData, areaOptions);
      }

    </script>

    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->    <!-- Templatemo Script -->
  </body>
</html>
