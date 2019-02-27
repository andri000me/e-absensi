<html>
  <head>
    <meta http-equiv="Content-Language" content="en-us">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta name="GENERATOR" content="Microsoft FrontPage 4.0">
    <meta name="ProgId" content="FrontPage.Editor.Document">
    <style type="text/css">
    @media print {
      .noprint {
        display: none;
      }
      table{
        font: 10px arial;
        border-collapse:collapse;
        border: 1px solid black;

      }
      th, td
      {
        border: 1px solid black; padding: 4px;
        border-collapse:collapse;
      }

      #meta th { width: <?php echo $space;?> text-align: right;  }
      #meta th.meta-head { text-align: center; background: #eee; }

    }
    #container {
      display: table;
      }
    #row  {
      display: table-row;
    }

    #left, #right, #middle {
      display: table-cell;
    }
    </style>
  </head>
<body>
  <center>
    <form name="myform" class="noprint">
      <!-- <input type="checkbox" name="mybox" onClick="breakeveryheader()">Seperate Header -->
      <input type="button" value="Print" onClick="window.print()">
    </form>
    <!-- <img src="../../kop/<?php echo $j;?>.png" width="795" class="img-responsive"> -->
    <br/><font size="6"></font>
  </center>

  <div id="container">
    <?php foreach ($data_mkterkini as $value) { ?>

      <div id="images" >
        <img style="width: 100%; height: auto;" src="<?php echo base_url();?>kop/<?php echo $value->IDPRODI; ?>.png">
      </div>
      <h3><center>BERITA ACARA PERKULIAHAN</h3>

      <div id="row">
      <div id="left">
        <?php
        if ($value->NAMAKLS == 01) {
          $kelas = "A";
        } elseif ($value->NAMAKLS == 02) {
          $kelas = "B";
        }else {
          $kelas = "NR";
        }
         ?>
        <span style="padding-right:50px;">Program Studi</span><span style="padding-right:232px;">: <?php echo $value->NMPSTMSPST; ?></span><br/>
        <span style="padding-right:62px;">Mata Kuliah</span><span style="padding-right:232px;">: <?php echo $value->NAMAMK; ?></span><br/>
        <span style="padding-right:68px;">SMT/Kelas</span><span style="padding-right:184px;">: <?php echo $value->SEMESTER; ?>/<?php echo $kelas; ?></span><br/>
        <span style="padding-right:31px;">Tahun Akademik</span><span style="padding-right:184px;">: <?php echo $thnAjar; ?></span><br/>
        <span style="padding-right:30px;">Dosen Pengampu</span><span style="padding-right:180px;">:  <?php echo $this->session->userdata('nama');?></span><br/><br/>
      </div>
      <div id="middle">
        <h4></h4>
        <p></p>
      </div>
      <div id="right">
      </div>
      </div>
      <?php } ?>
    </div>
        <table border=1 id="meta" style="border-collapse:collapse; border: 1px solid black;">
          <thead>
            <tr>
              <th width="100px"><center>Pertemuan</center></th>
              <th width="200px"><center>Hari/Tanggal</center></th>
              <th width="200px"><center>Jam Masuk</center></th>
              <th width="200px"><center>Jam Keluar</center></th>
              <th width="400px"><center>Pokok & Sub Pokok Bahasan</th>
              <th width="400px"><center>Metode Pembahasan</th>
              <th width="400px"><center>Tugas yang Diberikan</th>
              <th width="100px"><center>Jumlah Mahasiswa Hadir</th>
              <th width="100px"><center>Jumlah Mahasiswa Tidak Hadir</th>
              <th width="100px"><center>Tanda Tangan Dosen</th>
              <th width="100px"><center>Ttd Mahasiswa</th>

            </tr>
          </thead>

          <tbody>
            <?php
            function tanggal_indo($tanggal){
              $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                  );
              $split = explode('-', $tanggal);
              return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
            }

            if(isset($brtAcrmk)){
              foreach($brtAcrmk as $value){?>
                <tr class="odd gradeX">
                  <td><center><?php echo $value->PERTEMUAN;?></td>
                  <?php

                  $tgl = $value->TGL;

                  $day = date('D', strtotime($tgl));
                  $dayList = array(
                  	'Sun' => 'Minggu',
                  	'Mon' => 'Senin',
                  	'Tue' => 'Selasa',
                  	'Wed' => 'Rabu',
                  	'Thu' => 'Kamis',
                  	'Fri' => 'Jumat',
                  	'Sat' => 'Sabtu'
                  );
                  // echo "Tanggal {$tgl} adalah hari : " . $dayList[$day];

                  $tgl_pertemuan = tanggal_indo($tgl);

                  $jm_t = $value->JM;
                  $jm = substr($jm_t,0, -3);

                  $jk_t = $value->JK;
                  $jk = substr($jk_t,0, -3);

                  ?>

                  <td><center><?php echo $dayList[$day]." / ".$tgl_pertemuan;?></td>
                  <td><center><?php echo $jm ;?> WIB</td>
                  <td><center><?php echo $jk ;?> WIB</td>
                  <td><?php echo $value->MATERI;?></td>
                  <td>

                  <!-- decode json code -->
                  <?php
                  $json = $value->METODE;
                  $hasil = json_decode($json, true);
                  foreach($hasil as $metode){
                    echo $metode.". ";
                  }
                  ?>
                  </td>

                  <td><?php echo $value->TUGAS;?></td>
                  <td><center><?php echo $value->JLHHADIR;?></td>
                  <td><center><?php echo $value->JLHABSEN;?></td>
                  <td><center></td>
                  <td><center></td>


                </tr><?php
              }
            }?>
          </tbody>
        </table>
        <h2></h2>
<script>
function breakeveryheader(){
  if (!document.getElementById){
    alert("You need IE5 or NS6 to run this example")
    return
  }
  var thestyle=(document.forms.myform.mybox.checked)? "always" : "auto"
  for (i=0; i<document.getElementsByTagName("H2").length; i++)
  document.getElementsByTagName("H2")[i].style.pageBreakBefore=thestyle
}
</script><!--webbot bot="HTMLMarkup" endspan -->
</p>
</body>
</html>
