<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Entri_taruna extends CI_Controller {
	function __construct(){
		parent::__construct();
		ini_set('date.timezone', 'Asia/Jakarta');
		$this->load->helper(array('form', 'url'));
		$this->load->model('my_model'); 
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
		}  
	}
	function simpan(){
		$this->load->library('form_validation');
		$this->load->helper('file');
		if($this->input->post('domisili') AND $this->input->post('id_taruna')){
			$id_taruna = trim($this->security->xss_clean($this->input->post('id_taruna')));
			$tempat_domisili = trim($this->security->xss_clean($this->input->post('tempat_domisili')));
			$pekerjaan = trim($this->security->xss_clean($this->input->post('pekerjaan')));
			$propinsi = trim($this->security->xss_clean($this->input->post('propinsi')));
			$kabupaten = trim($this->security->xss_clean($this->input->post('kabupaten')));
			$kecamatan = trim($this->security->xss_clean($this->input->post('kecamatan')));
			$desa = trim($this->security->xss_clean($this->input->post('desa')));
			$where = array('id_taruna'=>$id_taruna);
			if($propinsi !='' OR $kabupaten !='' OR $kecamatan !='' OR $desa !=''){
				$data = array('pekerjaan'=>$pekerjaan, 'tempat_domisili'=>$tempat_domisili, 'desa_domisili'=>$desa, 'kec_domisili'=>$kecamatan, 'kab_domisili'=>$kabupaten, 'prov_domisili'=>$propinsi);
			}else{
				$data = array('pekerjaan'=>$pekerjaan, 'tempat_domisili'=>$tempat_domisili);
			}
			if($this->my_model->update("tb_taruna", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/domisili');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/domisili');
			}
		}elseif($this->input->post('alamat') AND $this->input->post('id_taruna')){
			$id_taruna = trim($this->security->xss_clean($this->input->post('id_taruna')));
			$propinsi = trim($this->security->xss_clean($this->input->post('propinsi')));
			$kabupaten = trim($this->security->xss_clean($this->input->post('kabupaten')));
			$kecamatan = trim($this->security->xss_clean($this->input->post('kecamatan')));
			$desa = trim($this->security->xss_clean($this->input->post('desa')));
			$where = array('id_taruna'=>$id_taruna);
			if($propinsi !='' OR $kabupaten !='' OR $kecamatan !='' OR $desa !=''){
				$data = array('desa'=>$desa,'kec'=>$kecamatan, 'kab'=>$kabupaten, 'prov'=>$propinsi);
				if($this->my_model->update("tb_taruna", $where, $data)){
					$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
					redirect('entri_taruna/edit/'.$id_taruna.'/alamat');
				}else{
					$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
					redirect('entri_taruna/edit/'.$id_taruna.'/alamat');
				}
			}else{
				redirect('entri_taruna/edit/'.$id_taruna.'/alamat');
			}
		}elseif($this->input->post('ortu') AND $this->input->post('id_taruna')){
			$id_taruna = trim($this->security->xss_clean($this->input->post('id_taruna')));
			$ayah = trim($this->security->xss_clean($this->input->post('ayah')));
			$jobayah = trim($this->security->xss_clean($this->input->post('jobayah')));
			$suku_ayah = trim($this->security->xss_clean($this->input->post('suku_ayah')));
			$pangkat_ayah = trim($this->security->xss_clean($this->input->post('pangkat_ayah')));
			$satuan_ayah = trim($this->security->xss_clean($this->input->post('satuan_ayah')));
			$ibu = trim($this->security->xss_clean($this->input->post('ibu')));
			$job_ibu = trim($this->security->xss_clean($this->input->post('job_ibu')));
			$suku_ibu = trim($this->security->xss_clean($this->input->post('suku_ibu')));
			$propinsi = trim($this->security->xss_clean($this->input->post('propinsi')));
			$kabupaten = trim($this->security->xss_clean($this->input->post('kabupaten')));
			$kecamatan = trim($this->security->xss_clean($this->input->post('kecamatan')));
			$desa = trim($this->security->xss_clean($this->input->post('desa')));
			
			$where = array('id_taruna'=>$id_taruna);
			if($propinsi !='' OR $kabupaten !='' OR $kecamatan !='' OR $desa !=''){
				$data = array('nama_ayah'=>$ayah, 'pekerjaan_ayah'=>$jobayah, 'suku_ayah'=>$suku_ayah, 'pangkat_ayah'=>$pangkat_ayah, 'satuan_ayah'=>$satuan_ayah, 'nama_ibu'=>$ibu, 'pekerjaan_ibu'=>$job_ibu, 'suku_ibu'=>$suku_ibu, 'desa_ortu'=>$desa,'kec_ortu'=>$kecamatan, 'kab_ortu'=>$kabupaten, 'prov_ortu'=>$propinsi);
			}else{
				$data = array('nama_ayah'=>$ayah, 'pekerjaan_ayah'=>$jobayah, 'suku_ayah'=>$suku_ayah, 'pangkat_ayah'=>$pangkat_ayah, 'satuan_ayah'=>$satuan_ayah, 'nama_ibu'=>$ibu, 'pekerjaan_ibu'=>$job_ibu, 'suku_ibu'=>$suku_ibu);
			}
			if($this->my_model->update("tb_taruna", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/ortu');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Data Gagal diperbaharui.
				</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/ortu');
			}			
		}elseif($this->input->post('prestasi') AND $this->input->post('id_taruna')){
			$id_taruna = trim($this->security->xss_clean($this->input->post('id_taruna')));
			$keahlian = trim($this->security->xss_clean($this->input->post('keahlian')));
			$tingkat = trim($this->security->xss_clean($this->input->post('tingkat')));
			$where = array('id_taruna'=>$id_taruna);
			$data = array('keahlian'=>$keahlian,'tingkat'=>$tingkat);
			if($this->my_model->update("tb_taruna", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/prestasi');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/prestasi');
			}
		}elseif($this->input->post('kelulusan') AND $this->input->post('id_taruna')){
			$id_taruna = trim($this->security->xss_clean($this->input->post('id_taruna')));
			$status_lulus = trim($this->security->xss_clean($this->input->post('status_lulus')));
			$where = array('id_taruna'=>$id_taruna);
			$data = array('status_kelulusan'=>$status_lulus);
			if($this->my_model->update("tb_taruna", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/kelulusan');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
				redirect('entri_taruna/edit/'.$id_taruna.'/kelulusan');
			}
		}else{
			$noreg = trim($this->security->xss_clean($this->input->post('noreg')));
			$nama = trim($this->security->xss_clean($this->input->post('nama')));
			$lahir = trim($this->security->xss_clean($this->input->post('lahir')));
			$tgllhr = trim($this->security->xss_clean($this->input->post('tgllhr')));
			$dikum = trim($this->security->xss_clean($this->input->post('dikum')));
			$jurusan = trim($this->security->xss_clean($this->input->post('jurusan')));
			$thnlulus = trim($this->security->xss_clean($this->input->post('thnlulus')));
			$uan = trim($this->security->xss_clean($this->input->post('uan')));
			$tb = trim($this->security->xss_clean($this->input->post('tb')));
			$bb = trim($this->security->xss_clean($this->input->post('bb')));
			$agama = trim($this->security->xss_clean($this->input->post('agama')));
			$hp = trim($this->security->xss_clean($this->input->post('hp')));
			$asalsekolah = trim($this->security->xss_clean($this->input->post('asalsekolah')));
			$bidang = trim($this->security->xss_clean($this->input->post('bidang')));
			$jk = trim($this->security->xss_clean($this->input->post('jk')));
			
			$this->form_validation->set_rules('noreg','Kode Registrasi','required');
			$this->form_validation->set_rules('nama','Nama Peserta','required');
			$this->form_validation->set_rules('lahir','Tempat Lahir','required');
			$this->form_validation->set_rules('tgllhr','Tanggal Lahir','required');
			$this->form_validation->set_rules('dikum','DIKUM','required');
			$waktuSkr = date("Y-m-d H:i:s");
			
			if($this->form_validation->run() == true){
				$where = array('status_periode' => 'Y');
				$CekPriode = $this->my_model->cek_data("tb_periode", $where)->row_array();
				if($_FILES['fotofisik']['name'] != ''){
					$config['file_name'] = $noreg."_".$_FILES["fotofisik"]['name'];
					$config['upload_path']          = './upload/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					//$config['max_size']             = 2048;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('fotofisik')){
						$uploadData = $this->upload->data();
						$uploadFile = $uploadData['file_name'];
						if($this->input->post('fototaruna') != ''){
							unlink('./upload/'.$this->input->post('fototaruna'));
						}
						if($this->input->post('id_taruna')){
							$id_taruna = trim($this->security->xss_clean($this->input->post('id_taruna')));
							$where = array('id_taruna'=>$id_taruna);
							if($this->my_model->cek_data("tb_taruna", $where)->num_rows() >= 1){
								$data = array('no_daftar'=>$noreg, 'nama'=>$nama, 'tempat_lahir'=>$lahir, 'tgl_lahir'=>$tgllhr, 'dikum'=>$dikum, 'jurusan'=>$jurusan, 'tahun_lulus'=>$thnlulus, 'nilai_uan'=>$uan, 'tb'=>$tb,'bb'=>$bb, 'agama'=>$agama, 'nohp'=>$hp, 'asal_sekolah'=>$asalsekolah, 'foto'=>$uploadFile, 'jk'=>$jk, 'bidang_keahlian'=>$bidang);
								if($this->my_model->update("tb_taruna", $where, $data)){
									$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
									redirect('entri_taruna/edit/'.$id_taruna);
								}else{
									$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
									redirect('entri_taruna/edit/'.$id_taruna);
								}
							}else{
								echo "<script type=\"text/javascript\">alert('Data yang diakses tidak dikenali. Silahkan coba lagi');window.history.go(-1);</script>";
							}
						}else{
							$data = array('no_daftar'=>$noreg, 'nama'=>$nama, 'id_periode'=>$CekPriode['id_periode'], 'tempat_lahir'=>$lahir, 'tgl_lahir'=>$tgllhr, 'dikum'=>$dikum, 'jurusan'=>$jurusan, 'tahun_lulus'=>$thnlulus, 'nilai_uan'=>$uan, 'tb'=>$tb,'bb'=>$bb, 'agama'=>$agama, 'nohp'=>$hp, 'asal_sekolah'=>$asalsekolah, 'foto'=>$uploadFile,'created'=>$waktuSkr, 'jk'=>$jk, 'bidang_keahlian'=>$bidang);
							if($this->my_model->tambahdata("tb_taruna", $data)){
								$DataLast = $this->my_model->get_last();
								$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disimpan.</div>");
								redirect('entri_taruna/edit/'.$DataLast->id_taruna .'/domisili');
							}else{
								$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan. Silahkan dicoba lagi.</div>");
								redirect('entri_taruna');
							}
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>File Gagal diUpload. $error</div>");
						redirect('entri_taruna');
					}
				}else{
					if($this->input->post('id_taruna')){
						$id_taruna = trim($this->security->xss_clean($this->input->post('id_taruna')));
						$where = array('id_taruna'=>$id_taruna);
						if($this->my_model->cek_data("tb_taruna", $where)->num_rows() >= 1){
							$data = array('no_daftar'=>$noreg, 'nama'=>$nama, 'tempat_lahir'=>$lahir, 'tgl_lahir'=>$tgllhr, 'dikum'=>$dikum, 'jurusan'=>$jurusan, 'tahun_lulus'=>$thnlulus, 'nilai_uan'=>$uan, 'tb'=>$tb,'bb'=>$bb, 'agama'=>$agama, 'nohp'=>$hp, 'asal_sekolah'=>$asalsekolah, 'jk'=>$jk, 'bidang_keahlian'=>$bidang);
							if($this->my_model->update("tb_taruna", $where, $data)){
								$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
								redirect('entri_taruna/edit/'.$id_taruna);
							}else{
								$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Data Gagal diperbaharui.
								</div>");
								redirect('entri_taruna/edit/'.$id_taruna);
							}
						}else{
							echo "<script type=\"text/javascript\">alert('Data yang diakses tidak dikenali. Silahkan coba lagi');window.history.go(-1);</script>";
						}
					}else{
						$data = array('no_daftar'=>$noreg, 'nama'=>$nama, 'id_periode'=>$CekPriode['id_periode'], 'tempat_lahir'=>$lahir, 'tgl_lahir'=>$tgllhr, 'dikum'=>$dikum, 'jurusan'=>$jurusan, 'tahun_lulus'=>$thnlulus, 'nilai_uan'=>$uan, 'tb'=>$tb,'bb'=>$bb, 'agama'=>$agama, 'nohp'=>$hp, 'asal_sekolah'=>$asalsekolah, 'created'=>$waktuSkr, 'jk'=>$jk, 'bidang_keahlian'=>$bidang);
						if($this->my_model->tambahdata("tb_taruna", $data)){
							$DataLast = $this->my_model->get_last();
							$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Data berhasil disimpan.
							</div>");
							redirect('entri_taruna/edit/'.$DataLast->id_taruna .'/domisili');
						}else{
							$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Data Gagal disimpan. Silahkan dicoba lagi.
							</div>");
							redirect('entri_taruna');
						}
					}
				}
			}else{
				echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
			}
		}		
	}
	
	function hapus(){
		$id_taruna = $this->uri->segment(3);
		$where = array('id_taruna' => $id_taruna);
		$CekData = $this->my_model->cek_data("tb_taruna", $where)->row_array();
		if($CekData['foto'] != ''){
			unlink('./upload/'.$CekData['foto_brg']);
		}
		if($this->my_model->hapus("tb_taruna", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect('data_taruna');
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect('data_taruna');
		}
	}
	
	function kabupaten(){
        $propinsiID = $_GET['id'];
        $kabupaten = $this->db->get_where('kabupaten',array('id_prov'=>$propinsiID));
		echo "
		<div class='form-group'>
			<label class='col-sm-2 control-label hor-form' for='kabupaten'>Kabupaten</label>
			<div class='col-sm-4'>
				<select id='kabupaten' name='kabupaten' onChange='loadKecamatan()' class='form-control'>
					<option value=''>-- PILIH --</option>";
					foreach($kabupaten->result() as $k){
						if($propinsiID == $k->id){
							echo "<option value='$k->id' selected>$k->nama</option>";
						}else{
							echo "<option value='$k->id'>$k->nama</option>";
						}
					} echo "
				</select>
			</div>
		</div>";
		
    }
    
    function kecamatan(){
        $kabupatenID = $_GET['id'];
        $kecamatan = $this->db->get_where('kecamatan',array('id_kabupaten'=>$kabupatenID)); echo "
		<div class='form-group'>
			<label class='col-sm-2 control-label hor-form' for='kecamatan'>Kecamatan</label>
			<div class='col-sm-4'>
				<select id='kecamatan' name='kecamatan' onChange='loadDesa()' class='form-control'>
					<option value=''>-- PILIH --</option>";
					foreach ($kecamatan->result() as $k){
						echo "<option value='$k->id'>$k->nama</option>";
					}echo "
				</select>
			</div>
		</div>";
    }
    
    function desa(){
        $kecamatanID  = $_GET['id'];
        $desa = $this->db->get_where('desa',array('id_kecamatan'=>$kecamatanID));echo "
		<div class='form-group'>
			<label class='col-sm-2 control-label hor-form' for='desa'>Desa</label>
			<div class='col-sm-4'>
				<select id='desa' name='desa' class='form-control'>
					<option value=''>-- PILIH --</option>";
					foreach ($desa->result() as $d){
						echo "<option value='$d->id'>$d->nama</option>";
					}echo "
				</select>
			</div>
		</div>";
    }
	
	function edit(){
		$id_taruna = $this->uri->segment(3);
		$where = array('id_taruna' => $id_taruna);
		$CekTaruna = $this->my_model->cek_data("tb_taruna", $where);
		
		$ListProv = $this->my_model->tampil('provinsi')->result();
		$ArrProv[''] = '-- PILIH --';
		foreach($ListProv as $row){
			$ArrProv[$row->id] = $row->nama;
		}
		$data['ListProv'] = $ArrProv;
		
		//$data['propinsi'] = $this->db->get('provinsi');
		if($CekTaruna->num_rows() >= 1 OR $CekTaruna != ''){
			$data['Tampil'] = $CekTaruna->result();
			if($this->uri->segment(4) AND $this->uri->segment(4)=='domisili'){
				if($this->uri->segment(5) AND $this->uri->segment(5)=='reset'){
					$where = array('id_taruna'=>$id_taruna);
					$data = array('desa_domisili'=>'', 'kec_domisili'=>'', 'kab_domisili'=>'', 'prov_domisili'=>'');
					if($this->my_model->update("tb_taruna", $where, $data)){
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Silahkan ubah data alamat.</div>");
						redirect('entri_taruna/edit/'.$id_taruna.'/domisili');
					}else{
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Proses Gagal.</div>");
						redirect('entri_taruna/edit/'.$id_taruna.'/domisili');
					}
				}
				
				$data['body'] = "body/view_edit_domisili";
				$ListJob = $this->my_model->tampil('tb_pekerjaan')->result();
				$ArrJob[''] = '-- PILIH --';
				foreach($ListJob as $row){
					$ArrJob[$row->id_job] = $row->nama_job;
				}
				$data['ListJob'] = $ArrJob;	
				
				$CekData = $this->my_model->cek_data("tb_taruna", $where);
				$AmbilData = $CekData->row();
				if($AmbilData->prov_domisili != ''){
					$where = array('id_prov' => $AmbilData->prov_domisili);
					$ListKab = $this->my_model->cek_data("kabupaten", $where)->result();
					$ArrKab[''] = '-- PILIH --';
					foreach($ListKab as $row){
						$ArrKab[$row->id] = $row->nama;
					}
					$data['ListKab'] = $ArrKab;
				}
				if($AmbilData->kab_domisili != ''){
					$where = array('id_kabupaten' => $AmbilData->kab_domisili);
					$ListKec = $this->my_model->cek_data('kecamatan', $where)->result();
					$ArrKec[''] = '-- PILIH --';
					foreach($ListKec as $row){
						$ArrKec[$row->id] = $row->nama;
					}
					$data['ListKec'] = $ArrKec;
				}
				if($AmbilData->kec_domisili != ''){
					$where = array('id_kecamatan' => $AmbilData->kec_domisili);
					$ListDesa = $this->my_model->cek_data('desa', $where)->result();
					$ArrKec[''] = '-- PILIH --';
					foreach($ListDesa as $row){
						$ArrDesa[$row->id] = $row->nama;
					}
					$data['ListDesa'] = $ArrDesa;
				}
			}elseif($this->uri->segment(4) AND $this->uri->segment(4)=='alamat'){
				if($this->uri->segment(5) AND $this->uri->segment(5)=='reset'){
					$where = array('id_taruna'=>$id_taruna);
					$data = array('kec'=>'', 'kab'=>'', 'desa'=>'', 'prov'=>'');
					if($this->my_model->update("tb_taruna", $where, $data)){
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Silahkan ubah data alamat.</div>");
						redirect('entri_taruna/edit/'.$id_taruna.'/alamat');
					}else{
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Proses Gagal.</div>");
						redirect('entri_taruna/edit/'.$id_taruna.'/alamat');
					}
				}
				$where = array('id_taruna'=>$id_taruna);
				$CekData = $this->my_model->cek_data("tb_taruna", $where);
				$AmbilData = $CekData->row();
				if($AmbilData->prov != ''){
					$where = array('id_prov' => $AmbilData->prov);
					$ListKab = $this->my_model->cek_data("kabupaten", $where)->result();
					$ArrKab[''] = '-- PILIH --';
					foreach($ListKab as $row){
						$ArrKab[$row->id] = $row->nama;
					}
					$data['ListKab'] = $ArrKab;
				}
				if($AmbilData->kab != ''){
					$where = array('id_kabupaten' => $AmbilData->kab);
					$ListKec = $this->my_model->cek_data('kecamatan', $where)->result();
					$ArrKec[''] = '-- PILIH --';
					foreach($ListKec as $row){
						$ArrKec[$row->id] = $row->nama;
					}
					$data['ListKec'] = $ArrKec;
				}
				if($AmbilData->kec != ''){
					$where = array('id_kecamatan' => $AmbilData->kec);
					$ListDesa = $this->my_model->cek_data('desa', $where)->result();
					$ArrKec[''] = '-- PILIH --';
					foreach($ListDesa as $row){
						$ArrDesa[$row->id] = $row->nama;
					}
					$data['ListDesa'] = $ArrDesa;
				}
				$data['body'] = "body/view_edit_alamat";			
			}elseif($this->uri->segment(4) AND $this->uri->segment(4)=='ortu'){
				if($this->uri->segment(5) AND $this->uri->segment(5)=='reset'){
					$where = array('id_taruna'=>$id_taruna);
					$data = array('kec_ortu'=>'', 'kab_ortu'=>'', 'desa_ortu'=>'', 'prov_ortu'=>'');
					if($this->my_model->update("tb_taruna", $where, $data)){
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Silahkan ubah data alamat.</div>");
						redirect('entri_taruna/edit/'.$id_taruna.'/ortu');
					}else{
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Proses Gagal.</div>");
						redirect('entri_taruna/edit/'.$id_taruna.'/ortu');
					}
				}
				$data['body'] = "body/view_edit_ortu";
				$ListJob = $this->my_model->tampil('tb_pekerjaan')->result();
				$ArrJob[''] = '-- PILIH --';
				foreach($ListJob as $row){
					$ArrJob[$row->id_job] = $row->nama_job;
				}
				$data['ListJob'] = $ArrJob;	
				
				$ListSuku = $this->my_model->tampil('tb_suku')->result();
				$ArrSuku[''] = '-- PILIH --';
				foreach($ListSuku as $row){
					$ArrSuku[$row->id_suku] = $row->nama_suku;
				}
				$data['ListSuku'] = $ArrSuku;	
				
				$CekData = $this->my_model->cek_data("tb_taruna", $where);
				$AmbilData = $CekData->row();
				if($AmbilData->prov_ortu != ''){
					$where = array('id_prov' => $AmbilData->prov_ortu);
					$ListKab = $this->my_model->cek_data("kabupaten", $where)->result();
					$ArrKab[''] = '-- PILIH --';
					foreach($ListKab as $row){
						$ArrKab[$row->id] = $row->nama;
					}
					$data['ListKab'] = $ArrKab;
				}
				if($AmbilData->kab_ortu != ''){
					$where = array('id_kabupaten' => $AmbilData->kab_ortu);
					$ListKec = $this->my_model->cek_data('kecamatan', $where)->result();
					$ArrKec[''] = '-- PILIH --';
					foreach($ListKec as $row){
						$ArrKec[$row->id] = $row->nama;
					}
					$data['ListKec'] = $ArrKec;
				}
				if($AmbilData->kec_ortu != ''){
					$where = array('id_kecamatan' => $AmbilData->kec_ortu);
					$ListDesa = $this->my_model->cek_data('desa', $where)->result();
					$ArrKec[''] = '-- PILIH --';
					foreach($ListDesa as $row){
						$ArrDesa[$row->id] = $row->nama;
					}
					$data['ListDesa'] = $ArrDesa;
				}
			}elseif($this->uri->segment(4) AND $this->uri->segment(4)=='kelulusan'){
				$where = array('id_taruna'=>$id_taruna);
				$CekData = $this->my_model->cek_data("tb_taruna", $where);
				$AmbilData = $CekData->row();
				$data['status_lulus'] = array("" => "-- PILIH --", "Y" => "Lulus", "N" => "Tidak Lulus");
				$data['body'] = "body/view_edit_kelulusan";	
				
			}elseif($this->uri->segment(4) AND $this->uri->segment(4)=='prestasi'){
				$where = array('id_taruna'=>$id_taruna);
				$CekData = $this->my_model->cek_data("tb_taruna", $where);
				$AmbilData = $CekData->row();
				$data['body'] = "body/view_edit_prestasi";	
				
			}else{
				$data['body'] = "body/view_edit_taruna";
				$CekDikum = $this->my_model->tampil('tb_dikum')->result();
				$ArrDikum[''] = '-- PILIH --';
				foreach($CekDikum as $row){
					$ArrDikum[$row->id_dikum] = $row->nama_dikum;
				}
				$data['Dikum'] = $ArrDikum;
				
				$CekAgama = $this->my_model->tampil('tb_agama')->result();
				$ArrAgama[''] = '-- PILIH --';
				foreach($CekAgama as $row){
					$ArrAgama[$row->id_agama] = $row->nama_agama;
				}
				$data['Agama'] = $ArrAgama;
				
				$dataTahun[''] = '-- PILIH --';
				for($thn=date("Y");  $thn >= 2000; $thn--){
					$dataTahun[$thn] = $thn;
				}
				$data['ThnLulus'] = $dataTahun;
				
				$data['ListBidang'] = array("" => "-- PILIH --", "Reguler" => "Reguler", "Atlet" => "Atlet", "Unggulan" => "Unggulan");
			}						
		}else{
			$data['body'] = "404";
		}
		$data['header'] = "header/header";
		$data['navbar'] = "navbar/navbar";
		$data['sidebar'] = "sidebar/sidebar";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$where = array('status_periode'=> 'Y');
		$data['StatusPeriode'] = $this->my_model->cek_data("tb_periode", $where)->num_rows();
		if($data['StatusPeriode'] <= 0){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Periode Pendaftaran harus diaktifkan terlebih dahulu.</div>");
		}		
		$CekDikum = $this->my_model->tampil('tb_dikum')->result();
		$ArrDikum[''] = '-- PILIH --';
		foreach($CekDikum as $row){
			$ArrDikum[$row->id_dikum] = $row->nama_dikum;
		}
		$data['Dikum'] = $ArrDikum;
		
		$CekAgama = $this->my_model->tampil('tb_agama')->result();
		$ArrAgama[''] = '-- PILIH --';
		foreach($CekAgama as $row){
			$ArrAgama[$row->id_agama] = $row->nama_agama;
		}
		$data['Agama'] = $ArrAgama;
		
		$dataTahun[''] = '-- PILIH --';
		for($thn=date("Y");  $thn >= 2000; $thn--){
			$dataTahun[$thn] = $thn;
		}
		$data['ThnLulus'] = $dataTahun;
		$data['propinsi'] = $this->db->get('provinsi');
		
		$data['ListBidang'] = array("" => "-- PILIH --", "Reguler" => "Reguler", "Atlet" => "Atlet", "Unggulan" => "Unggulan");
		
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_entri_taruna";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>