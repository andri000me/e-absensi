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

				<h2><center>LAPORAN HADIR PERKULIAHAN</h2>
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
					<span style="padding-right:30px;">Dosen Pengampu</span><span style="padding-right:180px;">:  <?php echo $this->session->userdata('nama');?></span><br/>
					<span style="padding-right:62px;">Mata Kuliah</span><span style="padding-right:232px;">: <?php echo $value->NAMAMK; ?></span><br/>
					<span style="padding-right:68px;">SMT/Kelas</span><span style="padding-right:184px;">: <?php echo $value->SEMESTER; ?>/<?php echo $kelas; ?></span><br/>
					<span style="padding-right:31px;">Tahun Akademik</span><span style="padding-right:184px;">: <?php echo $thnAjar; ?></span><br/><br/>
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
								<th rowspan="2" width="3%"><center>No</center></th>
								<th rowspan="2"><center>NIM</center></th>
								<th rowspan="2"><center>Nama Mahasiswa</center></th>
								<th colspan="16"><center>Kehadiran Mahasiswa</th>
								<th rowspan="2" width="10%"><center>Jumlah Hadir</th>
								<th rowspan="2" width="10%"><center>Persentase Hadir</th>
							</tr>
							<?php
							for($pertemuan=1; $pertemuan <= 16; $pertemuan++){
								echo "<td><center>$pertemuan</td>";
							}
							 ?>
						</thead>

						<tbody>
							<?php
							 $IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
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

										$this->db->like("ABSENSI", "H");
										$this->db->from('absen_mhs');
										$this->db->where('IDMAHASISWA', $value->IDMAHASISWA);
										$this->db->where('THNSM', $value->THNSM);
										$this->db->where('IDMAKUL', $IDMAKUL);
										$jmlhhadir = $this->db->count_all_results();
										$pershdr = ($jmlhhadir/16) * 100;

										// $data['jmlhdr1'] = $jmlhhadir;
										 ?>
										<td width="50" style="text-align: center;"><?php print_r($jmlhhadir); ?></td>
										<td width="50" style="text-align: center;"><?php  print_r($pershdr); ?> %</td>
									</tr><?php
									$no++;
								}
							}?>
						</tbody>
					</table>

					<?php
					function tanggal_indo($tanggal)
					{
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

					$tanggal_now = tanggal_indo(date('Y-m-d'));
					// echo tanggal_indo('2016-03-20'); // 20 Maret 2016
					?>
					<span style=" position: absolute; right: 100px; button: 150px;">
					<h5>Banda Aceh, <?php echo $tanggal_now; ?></h5>
					<h5>Ka. Prodi</h5>
					<br><br>
					<p>(...................................)</p>
					</span>

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
