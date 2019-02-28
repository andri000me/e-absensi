<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('my_model');
		$this->load->library('form_validation');
		$this->load->helper('file');
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
		}
	}

	function actprofil(){
		$NamaDos = trim($this->security->xss_clean($this->input->post('NamaDos')));
		$keahlian = trim($this->security->xss_clean($this->input->post('keahlian')));
		$this->form_validation->set_rules('NamaDos','Nama Dosen','required');
		$uploded = date("Y-m-d H:i:s");
		if($this->form_validation->run() == true){
			$where = array('IDDOSEN'=>$this->session->userdata('id_user'));
			$CekData = $this->my_model->cek_data("profil_dosen", $where);
			if($CekData->num_rows() >= 1){
				$DataCek = $CekData->row_array();
				if($_FILES['picture']['name'] != ''){
					$config['file_name'] = $this->session->userdata('id_user')."_".$_FILES["picture"]['name'];
					$config['upload_path']          = './img/';
					$config['allowed_types']        = 'jpg|png';
					$config['max_size']             = 1048;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('picture')){
						$uploadData = $this->upload->data();
						$uploadFile = $uploadData['file_name'];
						$uploadTipe = $uploadData['file_type'];
						if($DataCek['PICTURE'] != "default.jpg"){
							unlink('./img/'.$DataCek['PICTURE']);
						}
						$data = array('NAMADOS'=>$NamaDos, 'PICTURE'=>$uploadFile, 'KEAHLIAN'=>$keahlian);
						if($this->my_model->update("profil_dosen", $where, $data)){
							$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
							redirect('profil');
						}else{
							$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
							redirect('profil');
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>File Gagal diUpload. $error</div>");
						redirect('profil');
					}
				}else{
					$data = array('NAMADOS'=>$NamaDos, 'KEAHLIAN'=>$keahlian);
					if($this->my_model->update("profil_dosen", $where, $data)){
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
						redirect('profil');
					}else{
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
						redirect('profil');
					}
				}
			}else{
				echo "<script type=\"text/javascript\">alert('Data yang diakses tidak dikenali. Silahkan coba lagi');window.history.go(-1);</script>";
			}

		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
	}

	public function sinkronisasi(){
		// $kirim = file_get_contents('http://10.10.3.51/mk_dosen/list_course/'.$this->session->userdata('id_user'));
		$kirim= $this->my_model->fetchUrl('https://data.uui.ac.id/mk_dosen/list_course/'.$this->session->userdata('id_user'));
		$respon = json_decode($kirim, true);
		if(isset($respon['status']) && $respon['status'] <= 0){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Sinkronisasi gagal. Data tidak ditemukan!</div>");
			redirect('home');
		}else{
			$SinkronDosen= $this->my_model->fetchUrl('https://data.uui.ac.id/dosen/detail_dos/'.$this->session->userdata('id_user'));
			// $SinkronDosen = file_get_contents('http://10.10.3.51/dosen/detail_dos/'.$this->session->userdata('id_user'));
			$responDos = json_decode($SinkronDosen, true);
			if(isset($respon['responDos']) && $respon['responDos'] <= 0){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Profil dosen tidak dapat disinkronisasi!</div>");
			}else{
				foreach($responDos as $data1 => $value1){
					$where = array('IDDOSEN' => $this->session->userdata('id_user'));
					$CekProfil= $this->my_model->cek_data("profil_dosen", $where);
					if($CekProfil->num_rows() >= 1){
						$data = array('PRODIDOS' => $value1['IDPRODI'], 'NAMAPRODIDOS' => $value1['NAMAPRODI']);
						$this->my_model->update("profil_dosen", $where, $data);
					}else{
						$data = array('IDDOSEN' => $this->session->userdata('id_user'), 'NAMADOS' => $value1['NAMADOS'], 'PRODIDOS' => $value1['IDPRODI'], 'NAMAPRODIDOS' => $value1['NAMAPRODI'], 'PICTURE' => "default.png");
						$this->my_model->tambahdata("profil_dosen", $data);
					}
				}
			}

			foreach($respon as $data => $value){
				$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $value['THSHM'], 'IDPRODI' => $value['IDPRODI'], 'IDMAKUL' => $value['IDMAKUL'], 'NAMAKLS' => $value['KELAS'], 'LABELKLS' => $value['NAMAKLS'], 'SEMESTER' => $value['SEMESTER']);
				$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
				if($CekMakul->num_rows() >= 1){
					$data = array('THSHM' => $value['THSHM'], 'IDPRODI' => $value['IDPRODI'], 'KDPSTMSPST' => $value['KDPSTMSPST'], 'NMPSTMSPST' => $value['NMPSTMSPST'], 'IDMAKUL' => $value['IDMAKUL'], 'NAMAKLS' => $value['KELAS'], 'LABELKLS' => $value['NAMAKLS'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN'], 'NAMAMK' => $value['NAMAMK']);
					$this->my_model->update("makul_dosen", $where, $data);
				}else{
					$data = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $value['THSHM'], 'IDPRODI' => $value['IDPRODI'], 'KDPSTMSPST' => $value['KDPSTMSPST'], 'NMPSTMSPST' => $value['NMPSTMSPST'], 'IDMAKUL' => $value['IDMAKUL'], 'NAMAKLS' => $value['KELAS'], 'LABELKLS' => $value['NAMAKLS'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN'], 'NAMAMK' => $value['NAMAMK']);
					$this->my_model->tambahdata("makul_dosen", $data);
				}
			}
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disinkronisasi!</div>");
			redirect('home/dataajar');
		}
	}

	public function sinkronisasi_mhs(){
		$IDMAKUL = trim($this->security->xss_clean($this->input->get('IDMAKUL')));
		$KELAS = trim($this->security->xss_clean($this->input->get('KELAS')));
		$THNSM = trim($this->security->xss_clean($this->input->get('THNSM')));
		$kirim= $this->my_model->fetchUrl('https://data.uui.ac.id/mk_dosen/list_mhs/'.$this->session->userdata('id_user').'?IDMAKUL='.$IDMAKUL.'&KELAS='.$KELAS.'&THNSM='.$THNSM);
		// $kirim = file_get_contents('http://10.10.3.51/mk_dosen/list_mhs/'.$this->session->userdata('id_user').'?IDMAKUL='.$IDMAKUL.'&KELAS='.$KELAS.'&THNSM='.$THNSM);
		$respon = json_decode($kirim, true);
		//echo $kirim;
		if(isset($respon['status']) && $respon['status'] <= 0){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Sinkronisasi gagal. Data tidak ditemukan!</div>");
			redirect('home');
		}else{
			foreach($respon as $data => $value){
				$where = array('IDMAHASISWA' => $value['IDMAHASISWA'], 'IDMAKUL' => $value['IDMAKUL'], 'KELAS' => $value['KELAS'], 'THNSM' => $value['THNSM'], 'SEMESTER' => $value['SEMESTER']);
				$CekMhs= $this->my_model->cek_data("mhs_course", $where);
				if($CekMhs->num_rows() >= 1){
					$data = array('IDMAHASISWA' => $value['IDMAHASISWA'], 'NAMAMHS' => $value['NAMAMHS'], 'IDMAKUL' => $value['IDMAKUL'], 'KELAS' => $value['KELAS'], 'THNSM' => $value['THNSM'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN']);
					$this->my_model->update("mhs_course", $where, $data);
				}else{
					$data = array('IDMAHASISWA' => $value['IDMAHASISWA'], 'NAMAMHS' => $value['NAMAMHS'], 'IDMAKUL' => $value['IDMAKUL'], 'KELAS' => $value['KELAS'], 'THNSM' => $value['THNSM'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN']);
					$this->my_model->tambahdata("mhs_course", $data);
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function dataajar(){
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$this->db->select('THSHM, COUNT(THSHM) as jlh');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
		if($CekMakul->num_rows() >= 1){
			$data['data_mk'] = $CekMakul->result();
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
		}
		$data['header'] = "header/header2";
        $data['navbar'] = "navbar/navbar2";
        $data['sidebar'] = "sidebar/sidebar2";
        $data['body'] = "body/view_dataajar2";
		$data['footer'] = "footer/footer2";
		$this->load->view('template', $data);
	}

	public function index(){
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$this->db->select('THSHM, COUNT(THSHM) as jlh');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
		if($CekMakul->num_rows() >= 1){
			$data['data_mk'] = $CekMakul->result();
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
		}

		$this->db->select('THSHM');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$this->db->limit(1);
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$LasThnAjar= $this->my_model->cek_data("makul_dosen", $where);
		if($LasThnAjar->num_rows() >= 1){
			$showLasThnAjar= $LasThnAjar->row();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $showLasThnAjar->THSHM);
			$this->db->order_by('NAMAMK', 'ASC');
			$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
			if($CekMakul->num_rows() >= 1){
				$thn_ajr = substr($showLasThnAjar->THSHM, 0, -1);
				$smt = substr($showLasThnAjar->THSHM, -1);
				if($smt % 2 != 0){
					$smt_show = "GANJIL";
				}else{
					$smt_show = "GENAP";
				}
				$data['thnAjarInt'] = $showLasThnAjar->THSHM;
				$data['thnAjar'] = $smt_show." ".$thn_ajr;
				$data['data_mkterkini'] = $CekMakul->result();
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
			}
		}

		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$this->db->order_by('NAMA_FILE', 'ASC');
		$CekMateri= $this->my_model->cek_data("bahan_ajar", $where);
		if($CekMateri->num_rows() >= 1){
			$data['TotalMateri'] = $CekMateri->num_rows();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'pdf');
			$data['jlh_adobe'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_adobe'] = round(($data['jlh_adobe']/$data['TotalMateri'])*100, 2);

			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'msword');
			$data['jlh_word'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_word'] = round(($data['jlh_word']/$data['TotalMateri'])*100, 2);

			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'mspowerpoint');
			$data['jlh_powerpoint'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_powerpoint'] = round(($data['jlh_powerpoint']/$data['TotalMateri'])*100, 2);

			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'postscript');
			$data['jlh_poscript'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_poscript'] = round(($data['jlh_poscript']/$data['TotalMateri'])*100, 2);
		}else{
			$data['TotalMateri'] = $data['persen_adobe'] = $data['persen_poscript'] = $data['persen_word'] = $data['persen_powerpoint'] = 0;
			$data['jlh_adobe'] = $data['jlh_poscript'] = $data['jlh_word'] = $data['jlh_powerpoint'] = 0;
		}
		$data['SifatDokumen'] = array("1" => "Open/Publik", "0" => "Private/Khusus Mahasiswa");

		$data['header'] = "header/header2";
        $data['navbar'] = "navbar/navbar2";
        $data['sidebar'] = "sidebar/sidebar2";
        $data['body'] = "body/dashboard2";
		$data['footer'] = "footer/footer2";
		$this->load->view('template', $data);
	}
}
?>
