<?php
error_reporting(0);
session_start();
include "../../listrik.php";
require "../../indo_tgl.php";
ini_set('date.timezone', 'Asia/Jakarta');
$cek = mysqli_query($mysqli,"SELECT * FROM uui_users WHERE username='$_SESSION[username]' AND password='$_SESSION[password]'");
if(mysqli_num_rows($cek)==0){
	echo "<script type=\"text/javascript\">window.location.href=\"../../login_cek.php?op=out\";</script>";
}else{
$jns_absen=$_GET['jns_absen'];
$space = "30px;";?>
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

				  
				}
				th, td
				{
				  padding:4px 4px;
				  border: padding: 4px;			 
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
			<style type="text/css">
			.makeborder td {
				font-size:12px;
				padding:0px 10px;
				margin:0px;
				}
			</style>
			<style type="text/css">
			body {}
			tr {
				padding:5px;
				border:1px solid black;
				}
			td {
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
				font-size:12px;
				}
			</style>
		</head>
	<body><?php
	if($jns_absen == 3){
		$absensi = "DAFTAR HADIR UJIAN AKHIR SEMESTER";
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
				$prodi=mysqli_fetch_array(mysqli_query($mysqli, "SELECT * from PRODI where ID='$b'"));
				$jenjang=mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tbkod where KDAPLTBKOD='04' AND KDKODTBKOD='$prodi[TINGKAT]'"));?>
				<center>
				<form name="myform" class="noprint">
					<input type="checkbox" name="mybox" onClick="breakeveryheader()">Seperate Header
					<input type="button" value="Print" onClick="window.print()">
				</form><img src="../../kop/<?php echo $j;?>.png" width="795" class="img-responsive"/>
				<br/><font size="5"><?php echo $absensi; ?></font><br/><br/>
				<div id="container">
					<div id="row">
						<table  width=750 border="0" cellspacing="0" cellpadding="0" class="makeborder">
							<tr valign=top>
								<td width=75%>
									<table border="0" cellspacing="0" cellpadding="0">
										<tr align=left>
											<td nowrap>Dosen Pengampu</td>
											<td nowrap>&nbsp;: <?php echo $dosen['NAMA'];?></td>
										</tr>
										<tr align=left>
											<td nowrap>Mata Kuliah</td>
											<td>&nbsp;: <?php echo $e." - ".$nama_mk['NAKMKTBKMK'];?></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td width=50% cellpadding="2">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr align=left>
											<td nowrap>SMT/SKS/Kelas</td>
											<td nowrap>&nbsp;: <?php echo intval($nama_mk['SEMESTBKMK']);?>/<?php echo $nama_mk['SKSMKTBKMK'];?>/<?php echo $kelas['NAMA'];?></td>
										</tr>
										<tr align=left>
											<td nowrap>Tahun Akademik</td>
											<td nowrap>&nbsp;: <?php echo $smester; ?> <?php echo substr($a, 0, -1);?>/<?php echo substr($a, 0, -1) + 1;?></td>
										</tr>
									</table>				
								</td>
							</tr>
						</table>
						<p></p><?php
						$baris=1;
						while($show_mhs = mysqli_fetch_array($mhs)){
							if($baris <= 35){
								if ($baris == 1){?>
									<table border=1 id="meta" style="border-collapse:collapse; border: 1px solid black;">
										<thead>
											<tr>
												<th rowspan="2" width="1%"><center>No</center></th>
												<th rowspan="2"><center>NIM</center></th>
												<th rowspan="2"><center>Nama Mahasiswa</center></th>
												<th rowspan="2"><center>Tanda Tangan</center></th>
												<th rowspan="2"><center>Etika 5%</th>
												<th rowspan="2"><center>Quiz 5%</th>
												<th rowspan="2"><center>Tugas 20%</th>
												<th rowspan="2"><center>UTS 30%</th>
												<th rowspan="2"><center>UAS 40%</th>
												<th rowspan="2"><center>Rata-rata 100%</th>
												<th rowspan="2"><center>Nilai Akhir</th>
											</tr>
										</thead>
										<tbody>
											<tr style="font-size:12px;">
												<td><center><?php echo $baris;?></center></td>
												<td><?php echo $show_mhs[0];?></td>
												<td><?php echo $show_mhs[1];?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><center>&nbsp; A &nbsp; B &nbsp; C &nbsp; D &nbsp; E &nbsp;</center></td>
											</tr><?php
								}else{
									if ($baris != 35){?>
											<tr style="font-size:12px;">
												<td><center><?php echo $baris;?></center></td>
												<td><?php echo $show_mhs[0];?></td>
												<td><?php echo $show_mhs[1];?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><center>&nbsp; A &nbsp; B &nbsp; C &nbsp; D &nbsp; E &nbsp;</center></td>
											</tr><?php
									}else{?>
											<tr style="font-size:12px;">
												<td><center><?php echo $baris;?></center></td>
												<td><?php echo $show_mhs[0];?></td>
												<td><?php echo $show_mhs[1];?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><center>&nbsp; A &nbsp; B &nbsp; C &nbsp; D &nbsp; E &nbsp;</center></td>
											</tr>
										</tbody>
									</table>
									<?php
									}
								}
							}else{
								if($baris == 36){?>
									<h2></h2>
									<center><img src="../../kop/<?php echo $j;?>.png" width="795" class="img-responsive">
									<br/><font size="6"><?php echo $absensi; ?></font></center><br/>
									<div id="container">
										<div id="row">
											<table  width=550 border="0" cellspacing="0" cellpadding="0" class="makeborder">
												<tr valign=top>
													<td width=75%>
														<table border="0" cellspacing="0" cellpadding="0">
															<tr align=left>
																<td nowrap>Dosen Pengampu</td>
																<td nowrap>&nbsp;: <?php echo $dosen['NAMA'];?></td>
															</tr>
															<tr align=left>
																<td nowrap>Mata Kuliah</td>
																<td>&nbsp;: <?php echo $nama_mk['NAKMKTBKMK'];?></td>
															</tr>
														</table>
													</td>
													<td>&nbsp;&nbsp;</td>
													<td width=50% cellpadding="2">
														<table border="0" cellspacing="0" cellpadding="0">
															<tr align=left>
																<td nowrap>SMT/SKS/Kelas</td>
																<td nowrap>&nbsp;: <?php echo intval($nama_mk['SEMESTBKMK']);?>/<?php echo $nama_mk['SKSMKTBKMK'];?>/<?php echo $kelas['NAMA'];?></td>
															</tr>
															<tr align=left>
																<td nowrap>Tahun Akademik</td>
																<td nowrap>&nbsp;: <?php echo $smester; ?> <?php echo substr($a, 0, -1);?>/<?php echo substr($a, 0, -1) + 1;?></td>
															</tr>
														</table>				
													</td>
												</tr>
											</table><br/>
											<table border=1 id="meta" style="border-collapse:collapse; border: 1px solid black;">
												<thead>
													<tr>
														<th rowspan="2" width="1%"><center>No</center></th>
														<th rowspan="2"><center>NIM</center></th>
														<th rowspan="2"><center>Nama Mahasiswa</center></th>
														<th rowspan="2"><center>Tanda Tangan</center></th>
														<th rowspan="2"><center>Etika 5%</th>
														<th rowspan="2"><center>Quiz 5%</th>
														<th rowspan="2"><center>Tugas 20%</th>
														<th rowspan="2"><center>UTS 30%</th>
														<th rowspan="2"><center>UAS 40%</th>
														<th rowspan="2"><center>Rata-rata 100%</th>
														<th rowspan="2"><center>Nilai Akhir</th>
													</tr>
												</thead>
												<tbody>
													<tr style="font-size:12px;">
														<td><center><?php echo $baris;?></center></td>
														<td><?php echo $show_mhs[0];?></td>
														<td><?php echo $show_mhs[1];?></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td><center>&nbsp; A &nbsp; B &nbsp; C &nbsp; D &nbsp; E &nbsp;</center></td>
													</tr><?php
								}else{
									if ($baris != $total){?>
													<tr style="font-size:12px;">
														<td><center><?php echo $baris;?></center></td>
														<td><?php echo $show_mhs[0];?></td>
														<td><?php echo $show_mhs[1];?></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td><center>&nbsp; A &nbsp; B &nbsp; C &nbsp; D &nbsp; E &nbsp;</center></td>
													</tr><?php
									}else{?>
													<tr style="font-size:12px;">
														<td><center><?php echo $baris;?></center></td>
														<td><?php echo $show_mhs[0];?></td>
														<td><?php echo $show_mhs[1];?></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td><center>&nbsp; A &nbsp; B &nbsp; C &nbsp; D &nbsp; E &nbsp;</center></td>
													</tr>
												</tbody>
											</table><?php
									}
								}?>
										</div>
									</div><?php
							}
							$baris = $baris+1;
						}?>
					
					<table border=0 width=650>
						<tr valign=top>
							<td nowrap>
								<b><br/><br/>
									Banda Aceh, <?php echo date('d');?> <?php echo getBulan(date('m'));?> <?php echo date('Y');?><br/>
									KETUA PRODI <?php echo $jenjang['NMKODTBKOD']." ".$prodi['NAMA'];?>
									<br/><br/><br/><br/><br/><br/>
									<u><?php echo $prodi['NAMAPIMPINAN'];?></u><br/>							
									NIK. <?php echo $prodi['NIPPIMPINAN'];?>
								</b>
							</td>
						</tr>
					</table>
					</div>
				</div>
			</center><?php
			}else{
				echo "<p><center>Tidak Ada Mahasiswa yang mengambil Mata Kuliah Ini..!</p>";
			}
		}else{
			echo "<p><center>Data Tidak di temukan..!</p>";
		}
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