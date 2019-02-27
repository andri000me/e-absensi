<?php
error_reporting(0);
session_start();
include "../../listrik.php";
ini_set('date.timezone', 'Asia/Jakarta');
$cek = mysqli_query($mysqli,"SELECT * FROM uui_users WHERE username='$_SESSION[username]' AND password='$_SESSION[password]'");
if(mysqli_num_rows($cek)==0){
	//echo $_SESSION['username']."<br/>";
	//echo $_SESSION['password']."<br/>";
	echo "<script type=\"text/javascript\">window.location.href=\"../../login_cek.php?op=out\";</script>";
}else{
$jns_absen=$_GET['jns_absen'];
if($jns_absen == 1){
	$space = "12px;";
}elseif($jns_absen == 5){
	$space = "30px;";
}?>
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
		<?php
	if($jns_absen == 1 OR $jns_absen == 5){
		if($jns_absen == 1){
			$absensi = "DAFTAR HADIR KULIAH";
		}elseif($jns_absen == 5){
			$absensi = "DAFTAR HADIR PRAKTIKUM";
		}
		$mk = $mysqli->prepare("SELECT a.THSHM,a.IDPRODI,b.KDPSTMSPST,b.NMPSTMSPST,a.IDMAKUL,a.KELAS,a.SEMESTER,a.TAHUN,b.IDX,a.IDDOSEN from dosenpengajar a JOIN mspst b ON a.IDPRODI = b.IDX
									where a.IDDOSEN=? AND a.THSHM=? AND a.IDMAKUL=? AND b.KDPSTMSPST=? AND a.KELAS=? AND a.SEMESTER=?");
		$mk->bind_param('iisisi', $a, $b, $c, $d, $e, $f);
		$a=$_GET['dosen'];
		$b=$_GET['thshm'];
		$c=$_GET['mk'];
		$d=$_GET['prodi'];
		$e=$_GET['kls'];
		$f=$_GET['smt'];
		$pertemuan=$_GET['jlh_pertemuan'];
		$mk->execute();
		$mk->store_result();
		$mk->bind_result($a,$b,$c,$d,$e,$f,$g,$i,$j,$k);
		$num_rows = $mk->num_rows;
		if ($num_rows > 0){
			$mk->fetch();
			$smt=substr($a, -1);
			if($smt==1){ $smester = "GANJIL"; }elseif($smt==2){ $smester = "GENAP"; }
			$dosen = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM dosen WHERE ID='$k'"));
			$kelas = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM labelkelas WHERE ID='$f'"));
			$nama_mk = mysqli_fetch_array(mysqli_query($mysqli,"select * from tbkmk where THSMSTBKMK='$a' AND KDKMKTBKMK='$e' AND KDPSTTBKMK='$c'"));
			$mhs = mysqli_query($mysqli,"SELECT a.IDMAHASISWA, b.NAMA, a.SEMESTERMAKUL FROM pengambilanmk a JOIN mahasiswa b ON a.IDMAHASISWA = b.ID
											 WHERE a.IDMAKUL='$e' AND a.KELAS='$f' AND a.THNSM='$a' AND a.TAHUN='$i' AND a.SEMESTER='$g' order by b.NAMA ASC");
			$total = mysqli_num_rows($mhs);
			if($total > 0){
		?>
				<center>
				<form name="myform" class="noprint">
					<input type="checkbox" name="mybox" onClick="breakeveryheader()">Seperate Header
					<input type="button" value="Print" onClick="window.print()">
				</form><img src="../../kop/<?php echo $j;?>.png" width="795" class="img-responsive">
				<br/><font size="6"><?php echo $absensi; ?></font></center>
				<div id="container">
				  <div id="row">
					<div id="left">
						<span style="padding-right:30px;">Dosen Pengampu</span><span style="padding-right:180px;">: <?php echo $dosen['NAMA'];?></span><br/>
						<span style="padding-right:62px;">Mata Kuliah</span><span style="padding-right:232px;">: <?php echo $e." - ".$nama_mk['NAKMKTBKMK'];?></span><br/>
						<span style="padding-right:35px;">SMT/SKS/Kelas</span><span style="padding-right:184px;">: <?php echo intval($nama_mk['SEMESTBKMK']);?>/<?php echo $nama_mk['SKSMKTBKMK'];?>/<?php echo $kelas['NAMA'];?></span><br/>
						<span style="padding-right:31px;">Tahun Akademik</span><span style="padding-right:184px;">: <?php echo $smester; ?> <?php echo substr($a, 0, -1);?>/<?php echo substr($a, 0, -1) + 1;?></span><br/>
					</div>
					<div id="middle">
						<h4></h4>
						<p></p>
					</div>
					<div id="right">
					</div>
					</div>
				</div><?php
				$baris=1;
				while($show_mhs = mysqli_fetch_array($mhs)){
					if($baris <= 35){
						if ($baris == 1){?>
							<table border=1 id="meta" style="border-collapse:collapse; border: 1px solid black;">
								<thead>
									<tr>
										<th rowspan="2" width="3%"><center>No</center></th>
										<th rowspan="2"><center>NIM</center></th>
										<th rowspan="2"><center>Nama Mahasiswa</center></th>
										<th colspan="<?php echo $pertemuan;?>"><center>Tanggal Pertemuan/Tanda Tangan</th>
										<th rowspan="2" width="10%"><center>Jumlah Hadir</th>
										<th rowspan="2" width="10%"><center>Persentase Hadir</th>
									</tr>
									<tr>
										<?php
										for ($i=1; $i<=$pertemuan ; $i++) {
										?>
											<th class="meta-head"><center><?php echo $i ;?></center></th>
										<?php
										}
										?>
									</tr>
								</thead>
								<tbody>
									<tr style="font-size:12px;">
										<td><center><?php echo $baris;?></center></td>
										<td><?php echo $show_mhs[0];?></td>
											<td><?php echo $show_mhs[1];?></td>
										<?php
										for ($i=1; $i<=$pertemuan ; $i++) {
										?>
											<td></td>
										<?php
										}
										?>
										<td></td>
										<td></td>
									</tr><?php
						}else{
							if ($baris != 35){?>
									<tr style="font-size:12px;">
										<td><center><?php echo $baris;?></center></td>
										<td><?php echo $show_mhs[0];?></td>
											<td><?php echo $show_mhs[1];?></td>
										<?php
										for ($i=1; $i<=$pertemuan ; $i++) {
										?>
											<td></td>
										<?php
										}
										?>
										<td></td>
										<td></td>
									</tr><?php
							}else{?>
									<tr style="font-size:12px;">
										<td><center><?php echo $baris;?></center></td>
										<td><?php echo $show_mhs[0];?></td>
											<td><?php echo $show_mhs[1];?></td>
										<?php
										for ($i=1; $i<=$pertemuan ; $i++) {
										?>
											<td></td>
										<?php
										}
										?>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table><?php
							}
						}
					}else{
						if($baris == 36){?>
							<h2></h2>
							<center><img src="../../kop/<?php echo $j;?>.png" width="795" class="img-responsive">
							<br/><font size="6"><?php echo $absensi; ?></font></center>
							<div id="container">
							  <div id="row">
								<div id="left">
									<span style="padding-right:30px;">Dosen Pengampu</span><span style="padding-right:180px;">: <?php echo $dosen['NAMA'];?></span><br/>
									<span style="padding-right:62px;">Mata Kuliah</span><span style="padding-right:232px;">: <?php echo $nama_mk['NAKMKTBKMK'];?></span><br/>
									<span style="padding-right:35px;">SMT/SKS/Kelas</span><span style="padding-right:184px;">: <?php echo intval($nama_mk['SEMESTBKMK']);?>/<?php echo $nama_mk['SKSMKTBKMK'];?>/<?php echo $kelas['NAMA'];?></span><br/>
									<span style="padding-right:31px;">Tahun Akademik</span><span style="padding-right:184px;">: <?php echo $smester; ?> <?php echo substr($a, 0, -1);?>/<?php echo substr($a, 0, -1) + 1;?></span><br/>
								</div>
								<div id="middle">
									<h4></h4>
									<p></p>
								</div>
								<div id="right">
								</div>
								</div>
							</div>
							<table border=1 style="border-collapse:collapse; border: 1px solid black;">
								<thead>
									<tr>
										<th rowspan="2" width="3%"><center>No</center></th>
										<th rowspan="2"><center>NIM</center></th>
										<th rowspan="2"><center>Nama Mahasiswa</center></th>
										<th colspan="<?php echo $pertemuan;?>"><center>Tanggal Pertemuan/Tanda Tangan</th>
										<th rowspan="2" width="10%"><center>Jumlah Hadir</th>
										<th rowspan="2" width="10%"><center>Persentase Hadir</th>
									</tr>
									<tr>
										<?php
										for ($i=1; $i<=$pertemuan ; $i++) {
										?>
											<th class="meta-head"><center><?php echo $i ;?></center></th>
										<?php
										}
										?>
									</tr>
								</thead>
								<tbody>
									<tr style="font-size:12px;">
										<td><center><?php echo $baris;?></center></td>
										<td><?php echo $show_mhs[0];?></td>
											<td><?php echo $show_mhs[1];?></td>
										<?php
										for ($i=1; $i<=$pertemuan ; $i++) {
										?>
											<td></td>
										<?php
										}
										?>
										<td></td>
										<td></td>
									</tr><?php
						}else{
							if ($baris != $total){?>
									<tr style="font-size:12px;">
										<td><center><?php echo $baris;?></center></td>
										<td><?php echo $show_mhs[0];?></td>
											<td><?php echo $show_mhs[1];?></td>
										<?php
										for ($i=1; $i<=$pertemuan ; $i++) {
										?>
											<td></td>
										<?php
										}
										?>
										<td></td>
										<td></td>
									</tr><?php
							}else{?>
									<tr style="font-size:12px;">
										<td><center><?php echo $baris;?></center></td>
										<td><?php echo $show_mhs[0];?></td>
											<td><?php echo $show_mhs[1];?></td>
										<?php
										for ($i=1; $i<=$pertemuan; $i++) {
										?>
											<td></td>
										<?php
										}
										?>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table><?php
							}
						}
					}
					$baris = $baris+1;
				}
			}else{
				echo "<p><center>Tidak Ada Mahasiswa yang mengambil Mata Kuliah Ini..!</p>";
			}
		}else{
			echo "<p><center>Data Tidak di temukan..!</p>";
		}
	}elseif($jns_absen == 3){
		include "absen_cetak_uas.php";
	}else{
		echo "<p><center>Kategori Absen tidak dikenali..!</p>";
	}?>
	<p><!--webbot bot="HTMLMarkup" startspan -->
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
	</html><?php
}?>
