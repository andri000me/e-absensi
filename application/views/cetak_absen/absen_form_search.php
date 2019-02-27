<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	include "absen_result.php";
}else{?>
	<section class="widget">
		<header>
			<h4><span class="fw-semi-bold">CETAK ABSENSI</span></h4><br>
		</header>
		<div class="widget-body">
			<form class="form-horizontal form-label-left" role="form" method="POST" action="index.php?p=cetak_absen">
				<fieldset>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="simple-select">Jenis Absensi</label>
						<div class="col-sm-3">
							<div class="radio radio-danger">
								<input type="radio" name="radio2" id="radio3" value="1" checked><label for="radio3">Kuliah</label>
							</div>
							<div class="radio radio-danger">
								<input type="radio" name="radio2" id="radio4" value="2"><label for="radio4">UTS</label>
							</div>
							<div class="radio radio-danger">
								<input type="radio" name="radio2" id="radio5" value="3"><label for="radio5">UAS</label>
							</div>
							<div class="radio radio-danger">
								<input type="radio" name="radio2" id="radio6" value="4" disabled><label for="radio6">Daftar Hadir dan Nilai</label>
							</div>
							<div class="radio radio-danger">
								<input type="radio" name="radio2" id="radio7" value="5"><label for="radio7">Kuliah Praktikum</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="simple-select">Tahun Akademik / Semester</label>
						<div class="col-sm-8">
							<select class="selectpicker" data-style="btn-default" data-width="auto" tabindex="-1" id="simple-select" name="thn"><?php
							$awal_thmsm = mysqli_fetch_array(mysqli_query($mysqli,"SELECT THSMSTBKMK FROM tbkmk order by THSMSTBKMK ASC LIMIT 1"));
							$awal = substr($awal_thmsm['THSMSTBKMK'], 0, -1);
							$akhir_thmsm = mysqli_fetch_array(mysqli_query($mysqli,"SELECT THSMSTBKMK FROM tbkmk order by THSMSTBKMK DESC LIMIT 1"));
							$akhir = substr($akhir_thmsm['THSMSTBKMK'], 0, -1);
							for ($t=$awal; $t<=$akhir; $t++){
								if(date("Y") == $t){?>
									<option value="<?php echo $t;?>" selected><?php echo $t;?>/<?php echo $t+1;?></option><?php
								}else{?>
									<option value="<?php echo $t;?>"><?php echo $t;?>/<?php echo $t+1;?></option><?php
								}
							}?>
							</select>
							<select class="selectpicker" data-style="btn-default" data-width="auto" tabindex="-1" id="simple-select" name="sm">
								<option value="1">Ganjil</option>
								<option value="2">Genap</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="simple-select">Jurusan / Program Studi</label>
						<div class="col-sm-8">
							<select class="selectpicker" data-style="btn-default" data-width="auto" tabindex="-1" id="simple-select" name="prodi"><?php
							$tingkat=array("S3" => 'A', "S2" => 'B', "S1" => 'C', "D-IV" => 'D', "D-III" => 'E', "D-II" => "F",
										   "D-I" => 'G', "Sp-1" => 'H', "Sp-2" => 'I', "Profesi" => 'J', "Non Akademik" => 'X');
							$prodi = mysqli_query($mysqli,"SELECT a.ID, a.NAMA, a.TINGKAT, b.KDPSTMSPST, b.NMPSTMSPST FROM prodi a JOIN mspst b ON a.ID = b.IDX");
							if(mysqli_num_rows($prodi) > 0){
								while($show_prodi = mysqli_fetch_array($prodi)){
								$tgkt = array_search($show_prodi['TINGKAT'], $tingkat);?>
									<option value="<?php echo $show_prodi['ID']?>"><?php echo $show_prodi['KDPSTMSPST']." - ".$show_prodi['NMPSTMSPST']." (".$tgkt.")";?></option><?php
								}
							}else{?>
								<option value="0">Not FOund</option><?php
							}?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="max-length">Jumlah Pertemuan</label>
						<div class="col-sm-1">
							<input id="prepended-input" class="form-control" size="10" type="text" placeholder="Kode MK" value="16" name="jlh_pertemuan">
						</div>
					</div>
					<!--<div class="form-group">
						<label class="col-sm-2 control-label" for="max-length">Kode MK</label>
						<div class="col-sm-2">
							<input id="prepended-input" class="form-control" size="10" type="text" placeholder="Kode MK" name="id_mk">
						</div>
						<a href="#">Daftar MK</a>
					</div>
					<!--
					<div class="form-group">
						<label class="col-sm-2 control-label" for="max-length">Nama MK</label>
						<div class="col-sm-3">
							 <input id="prepended-input" class="form-control" size="50" type="text" placeholder="Nama MK" name="nama_mk">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="max-length">Semester Makul</label>
						<div class="col-sm-1">
							 <input id="prepended-input" class="form-control" size="50" type="text" name="semester_makul">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="max-length">SKS</label>
						<div class="col-sm-1">
							 <input id="prepended-input" class="form-control" size="50" type="text" name="sks">
						</div>
					</div>
				   <div class="form-group">
						<label class="col-sm-2 control-label" for="simple-select">Jenis</label>
						<div class="col-sm-8">
							<select class="selectpicker" data-style="btn-default"
									data-width="auto"
									tabindex="-1" id="simple-select" name="jenis_mk">
								<option value="0">Semua</option>
								<option value="1">Teori</option>
								<option value="1">Praktek</option>
							</select>
						</div>
					</div>-->
					<div class="form-group">
						<label class="col-sm-2 control-label" for="simple-select">KELOMPOK KURIKULUM</label>
						<div class="col-sm-8">
							<select class="selectpicker" data-style="btn-default" data-width="auto" tabindex="-1" id="simple-select" name="jenis_mk">
								<option value="">REGULER</option>
								<option value="111">NON REGULER</option>
							</select>
						</div>
					</div>
					<!--
					<div class="form-group">
						<label class="col-sm-2 control-label" for="simple-select">KELOMPOK MATA KULIAH</label>
						<div class="col-sm-8">
							<select class="selectpicker" data-style="btn-default"
									data-width="auto"
									tabindex="-1" id="simple-select" name="jenis_mk">
								<option value="0">Semua</option>
								<option value="1">database</option>
							</select>
						</div>
					</div>-->
				</fieldset>
				<div class="form-actions">
					<div class="row">
						<div class="col-sm-offset-2 col-sm-7">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<button type="button" class="btn btn-inverse">Cancel</button>
						</div>
					</div>
				</div>
			</form>
		</div>	
	</section><?php
}?>