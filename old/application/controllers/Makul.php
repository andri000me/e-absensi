<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Makul extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('my_model'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('user_agent');
		ini_set('date.timezone', 'Asia/Jakarta');
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
		}
	}
	
	function hapus(){
		$IDSET = $this->uri->segment(3);
		$where = array('IDSET' => $IDSET);
		if($this->my_model->hapus("atur_bahan_ajar", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	
	public function entri(){
		$PERTEMUAN = trim($this->security->xss_clean($this->input->post('pertemuan')));
		$MATERI = trim($this->security->xss_clean($this->input->post('materi')));
		$IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
		$THSHM = trim($this->security->xss_clean($IdDos = $this->uri->segment(4)));
		$IDPRODI = trim($this->security->xss_clean($IdDos = $this->uri->segment(5)));
		$NAMAKLS = trim($this->security->xss_clean($IdDos = $this->uri->segment(6)));
		$SEMESTER = trim($this->security->xss_clean($IdDos = $this->uri->segment(7)));
		$CREATED = date("Y-m-d H:i:s", time());
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'PERTEMUAN' => $PERTEMUAN, 'MATERI' => $MATERI);
		$GetBahanAjar = $this->my_model->cek_data("atur_bahan_ajar", $where);
		if($GetBahanAjar->num_rows() >= 1){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Bahan Ajar ini sudah ditambahkan di pertemuan ini. Silahkan pilih bahan ajar yang lain..!</div>");
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$data = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'PERTEMUAN' => $PERTEMUAN, 'MATERI' => $MATERI, 'CREATED' => $CREATED);
			if($this->my_model->tambahdata("atur_bahan_ajar", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-info' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Bahan Ajar ini berhasil di tambah ke pertemuan ini..!</div>");
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Bahan Ajar ini gagal di tambah ke pertemuan ini..!</div>");
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function detail(){
		$IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
		$thnAjar = trim($this->security->xss_clean($IdDos = $this->uri->segment(4)));
		$IDPRODI = trim($this->security->xss_clean($IdDos = $this->uri->segment(5)));
		$NAMAKLS = trim($this->security->xss_clean($IdDos = $this->uri->segment(6)));
		$SEMESTER = trim($this->security->xss_clean($IdDos = $this->uri->segment(7)));
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
		if($CekMakul->num_rows() >= 1){
			$thn_ajr = substr($thnAjar, 0, -1);
			$smt = substr($thnAjar, -1);
			if($smt % 2 != 0){
				$smt_show = "GANJIL";
			}else{
				$smt_show = "GENAP";
			}
			$data['thnAjar'] = $smt_show." ".$thn_ajr;
			$data['thnAjarInt'] = $thnAjar;
			//print_r($CekMakul->result());
			
			$data['data_mk'] = $CekMakul->result();
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan ulangi kembali..!</div>");
		}
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$BahanAjar = $this->my_model->cek_data("bahan_ajar", $where)->result();
		$ArrBahanAjar[''] = '-- PILIH --';
		foreach($BahanAjar as $row){
			$ArrBahanAjar[$row->ID] = $row->NAMA_FILE;
		}
		$data['BahanAjar'] = $ArrBahanAjar;
		
		
		$ArrPertemuan[''] = '-- PILIH --';
		for($a=1; $a<=16; $a++){
			$ArrPertemuan[$a] = "Pertemuan ".$a;
		}
		$data['Pertemuan'] = $ArrPertemuan;
		
		if($this->input->get('pertemuan')){
			$pertemuan = trim($this->security->xss_clean($this->input->get('pertemuan')));
			$where = array('a.IDDOSEN' => $this->session->userdata('id_user'), 'a.THSHM' => $thnAjar, 'a.IDPRODI' => $IDPRODI, 'a.IDMAKUL' => $IDMAKUL, 'a.NAMAKLS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER, 'a.PERTEMUAN' => $pertemuan);
			$this->db->join('bahan_ajar b', 'b.ID = a.MATERI', 'join');
			$GetBahanAjar = $this->my_model->cek_data("atur_bahan_ajar a", $where);
			if($GetBahanAjar->num_rows() >= 1){
				$data['GetBahanAjar'] = $GetBahanAjar->result();
			}
		}
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_makul_detail";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
		//$this->load->view('body/view_makul_detail', $data);
	}
	
	public function view(){
		$thnAjar = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar);
		$this->db->order_by('NAMAMK', 'ASC');
		$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
		if($CekMakul->num_rows() >= 1){
			$thn_ajr = substr($thnAjar, 0, -1);
			$smt = substr($thnAjar, -1);
			if($smt % 2 != 0){
				$smt_show = "GANJIL";
			}else{
				$smt_show = "GENAP";
			}
			$data['thnAjarInt'] = $thnAjar;
			$data['thnAjar'] = $smt_show." ".$thn_ajr;
			$data['data_mk'] = $CekMakul->result();
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
		}		
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_makul_thsm";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function terkini(){
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
				$data['data_mk'] = $CekMakul->result();
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
			}
		}			
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_makul_terkini";
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
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/dashboard";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>