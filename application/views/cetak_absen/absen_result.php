<ol class="breadcrumb">
	<li>Dasboard</li>
	<li class="active">Kurikulum</li>
</ol>
<section class="widget">
	<header><?php
		if(isset($_POST['radio2']) AND $_POST['radio2']==3){
			$link="absen_cetak_uas.php";
		}elseif(isset($_POST['radio2']) AND $_POST['radio2']==2){
			$link="absen_cetak_uts.php";
		}else{
			$link="absen_cetak.php";
		}
		$prodi = $mysqli->prepare("SELECT a.ID, a.NAMA, a.TINGKAT, b.KDPSTMSPST, b.NMPSTMSPST FROM prodi a JOIN mspst b ON a.ID = b.IDX where a.ID=?");
		$prodi->bind_param('i', $s);
		$s = $_POST['prodi'];
		$prodi->execute(); 
		$prodi->store_result();
		$prodi->bind_result($aa,$bb,$cc,$dd,$ee);
		$prodi->fetch();
		if($_POST['sm']==1){
			$smester = "GANJIL";
		}elseif($_POST['sm']==2){
			$smester = "GENAP";
		}
		?>
		<h4>Data Dosen Pengajar <span class="fw-semi-bold"><?php echo $ee;?> <?php echo " ".$_POST['thn']; ?>/<?php echo $_POST['thn']+1; echo " ".$smester; ?>
		</span></h4>
		<div class="widget-controls">
			<a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
			<a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
			<a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
		</div>
	</header>
	<div class="widget-body">		
		<div class="mt"><?php
			$mk = $mysqli->prepare("SELECT a.THSHM,a.IDPRODI,b.KDPSTMSPST,b.NMPSTMSPST,a.IDMAKUL,a.KELAS,a.SEMESTER,a.TAHUN,a.IDDOSEN from dosenpengajar a JOIN mspst b ON a.IDPRODI = b.IDX 
									where a.IDPRODI=? AND a.THSHM=?");
			$mk->bind_param('si', $a, $b);
			$a = $_POST['prodi'];
			$b = $_POST['thn'].$_POST['sm'];
			$c = $_POST['jenis_mk'];
			$d = $_POST['jlh_pertemuan'];
			$jns_absen = $_POST['radio2'];
			$mk->execute(); 
			$mk->store_result();
			$mk->bind_result($THSHM,$IDPRODI,$KDPSTMSPST,$NMPSTMSPST,$IDMAKUL,$KELAS,$SEMESTER,$TAHUN,$IDDOSEN); 
			$num_rows= $mk->num_rows;
			$smt=substr($b, -1);
			if($smt==1){ $smester = "GANJIL"; }elseif($smt==2){ $smester = "GENAP"; }
			$no=1;	
			if ($num_rows > 0){?>
			<table id="datatable-table" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>KD</th>
						<th>NAMA MMK</th>
						<th>PENGASUH</th>
						<th>SKS</th>
						<th>KLS</th>
						<th>SMT</th>
						<th>PESERTA</th>
						<th>AKSI</th>
					</tr>
				</thead>
				<tbody><?php
				while($mk->fetch()){
					$dosen = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM dosen WHERE ID='$IDDOSEN'"));
					$nama_mk = mysqli_fetch_array(mysqli_query($mysqli,"select * from tbkmk where THSMSTBKMK='$THSHM' AND KDKMKTBKMK='$IDMAKUL' AND KDPSTTBKMK='$KDPSTMSPST'"));
					$jlh_mhs = mysqli_fetch_array(mysqli_query($mysqli,"SELECT COUNT(IDMAHASISWA) AS jlh FROM pengambilanmk WHERE IDMAKUL='$IDMAKUL' AND KELAS='$KELAS' AND THNSM='$THSHM'"));
					$show_mhs = mysqli_fetch_array(mysqli_query($mysqli,"SELECT SEMESTERMAKUL, SKSMAKUL FROM pengambilanmk WHERE IDMAKUL='$IDMAKUL' AND KELAS='$KELAS' AND THNSM='$THSHM'"));
					$nama_kelas = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM labelkelas WHERE ID='$KELAS'"));?>
					<tr>
						<td><?php echo $IDMAKUL; ?></td>
						<td><?php echo $nama_mk['NAKMKTBKMK'] ?></td>
						<td><?php echo "($IDDOSEN) ".$dosen['NAMA']; ?></td>
						<td><?php echo $show_mhs['SKSMAKUL']; ?></td>
						<td><center><?php echo $nama_kelas['NAMA']; ?></center></td>
						<td><center><?php echo $show_mhs['SEMESTERMAKUL']; ?></center></td>
						<td><center><?php echo $jlh_mhs['jlh']; ?></center></td>
						<td><center>
							<a href="./mod/absen/<?php echo $link;?>?thshm=<?php echo $THSHM;?>&thn=<?php echo $TAHUN; ?>&mk=<?php echo $IDMAKUL;?>&prodi=<?php echo $KDPSTMSPST;?>&kls=<?php echo $KELAS; ?>&smt=<?php echo $SEMESTER;?>&smtmk=<?php echo $show_mhs['SEMESTERMAKUL']; ?>&dosen=<?php echo $IDDOSEN; ?>&jlh_pertemuan=<?php echo $d;?>&jns_absen=<?php echo $jns_absen;?>" title="Cetak Absen" target="_blank">
							<button id="print" class="btn btn-inverse btn-xs">
                                <i class="fa fa-print"></i>
                                &nbsp;&nbsp;
                                Print
                            </button>
							</a></center>
						</td>
					</tr><?php
					$no=$no+1;
				}?>
				</tbody>
			</table><?php
			}else{
				echo "<span class=\"fw-semi-bold\"><p><center>Mata Kuliah Tidak di Temukan..!</p></span>";
			}?>
		</div>
	</div>
</section>