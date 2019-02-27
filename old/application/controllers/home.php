<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('my_model');
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
		}
	}

	public function sinkronisasi(){
		$kirim = file_get_contents('http://data.uui.ac.id/mk_dosen/list_course/'.$this->session->userdata('id_user'));
		$respon = json_decode($kirim, true);
		if(isset($respon['status']) && $respon['status'] <= 0){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Sinkronisasi gagal. Data tidak ditemukan!</div>");
			redirect('home');
		}else{
			foreach($respon as $data => $value){
				$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $value['THSHM'], 'IDPRODI' => $value['IDPRODI'], 'IDMAKUL' => $value['IDMAKUL'], 'NAMAKLS' => $value['NAMAKLS'], 'SEMESTER' => $value['SEMESTER']);
				$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
				if($CekMakul->num_rows() >= 1){
					$data = array('THSHM' => $value['THSHM'], 'IDPRODI' => $value['IDPRODI'], 'KDPSTMSPST' => $value['KDPSTMSPST'], 'NMPSTMSPST' => $value['NMPSTMSPST'], 'IDMAKUL' => $value['IDMAKUL'], 'NAMAKLS' => $value['NAMAKLS'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN'], 'NAMAMK' => $value['NAMAMK']);
					$this->my_model->update("makul_dosen", $where, $data);
				}else{
					$data = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $value['THSHM'], 'IDPRODI' => $value['IDPRODI'], 'KDPSTMSPST' => $value['KDPSTMSPST'], 'NMPSTMSPST' => $value['NMPSTMSPST'], 'IDMAKUL' => $value['IDMAKUL'], 'NAMAKLS' => $value['NAMAKLS'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN'], 'NAMAMK' => $value['NAMAMK']);
					$this->my_model->tambahdata("makul_dosen", $data);
				}
			}
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data mata kuliah berhasil disinkronisasi!</div>");
			redirect('home/dataajar');
		}
	}

	public function sinkronisasi2(){
		// $kirim = file_get_contents('http://data.uui.ac.id/mk_dosen/list_mhs/'.$this->session->userdata('id_user'));
		$kirim = file_get_contents('http://data.uui.ac.id/mk_dosen/list_mhs/231432?IDMAKUL=LAW321&KELAS=01&THNSM=20171');
		$respon = json_decode($kirim, true);
		if(isset($respon['status']) && $respon['status'] <= 0){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Sinkronisasi gagal. Data tidak ditemukan!</div>");
			redirect('home');
		}else{
			foreach($respon as $data => $value)
			{
				$where = array('IDMAHASISWA' => $value['IDMAHASISWA'], 'NAMAMHS' => $value['NAMAMHS'], 'IDMAKUL' => $value['IDMAKUL'], 'KELAS' => $value['KELAS'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN']);
				$CekMakul= $this->my_model->cek_data("absen_mhs", $where);
				if($CekMakul->num_rows() >= 1){
					$this->my_model->update("absen_mhs", $where, $data);
					$data = array('IDMAHASISWA' => $value['IDMAHASISWA'], 'NAMAMHS' => $value['NAMAMHS'], 'IDMAKUL' => $value['IDMAKUL'], 'KELAS' => $value['KELAS'],'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN']);
				}else{
					$data = array('IDMAHASISWA' => $value['IDMAHASISWA'], 'NAMAMHS' => $value['NAMAMHS'], 'IDMAKUL' => $value['IDMAKUL'], 'KELAS' => $value['KELAS'], 'SEMESTER' => $value['SEMESTER'], 'TAHUN' => $value['TAHUN']);
					$this->my_model->tambahdata("absen_mhs", $data);
				}
			}
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data mahasiswa berhasil disinkronisasi!</div>");
			redirect('absen');
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
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_dataajar";
		$data['footer'] = "footer/footer";
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

		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/dashboard";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>
