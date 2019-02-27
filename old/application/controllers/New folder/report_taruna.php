<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_taruna extends CI_Controller {
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
	function rekapitulasi(){		
		$where = array('status_periode'=> 'Y');
		$CekData = $this->my_model->cek_data("tb_periode", $where);
		$AmbilData = $CekData->row();
		$data['Periode'] = $AmbilData->nama_periode;
		
		$where = array('a.id_periode'=> $AmbilData->id_periode);
		$data['RekapJob'] = $this->my_model->rekap_job($where)->result();
		$data['RekapSuku'] = $this->my_model->rekap_suku($where)->result();
		$data['RekapDikum'] = $this->my_model->rekap_dikum($where)->result();
		$data['RekapAgama'] = $this->my_model->rekap_agama($where)->result();
		$where = array('id_periode'=> $AmbilData->id_periode);
		$data['RekapThnLulus'] = $this->my_model->rekap_thnlulus($where)->result();
		
		if($this->uri->segment(3) && $this->uri->segment(3) == 'pdf'){
			$data['header'] ='';
			$data['sidebar'] ='';
			$data['footer'] ='';
			$this->load->view('body/view_hasil_rekapitulasi', $data);
		}else{
			$data['body'] = "body/view_hasil_rekapitulasi";
			$data['header'] = "header/header";
			$data['navbar'] = "navbar/navbar";
			$data['sidebar'] = "sidebar/sidebar";
			$data['footer'] = "footer/footer";
			$this->load->view('template', $data);
		}
	}
	
	function cari(){
		$where = array('status_periode'=> 'Y');
		$CekData = $this->my_model->cek_data("tb_periode", $where);
		$AmbilData = $CekData->row();
		$PriodeAktif = $AmbilData->id_periode;
		$data['nama_periode'] = $AmbilData->nama_periode;
		
		$dikum = trim($this->security->xss_clean($this->input->post('dikum')));
		$agama = trim($this->security->xss_clean($this->input->post('agama')));
		$jobayah = trim($this->security->xss_clean($this->input->post('jobayah')));
		$propinsi = trim($this->security->xss_clean($this->input->post('propinsi')));
		$status_lulus = trim($this->security->xss_clean($this->input->post('status_lulus')));
		$jk = trim($this->security->xss_clean($this->input->post('jk')));
		$bidang = trim($this->security->xss_clean($this->input->post('bidang')));
	
		$data['TampilPeserta'] = $this->my_model->cek_cari($dikum,$agama,$jobayah,$propinsi,$status_lulus,$jk,$bidang,$PriodeAktif)->result();
		if($this->uri->segment(3) && $this->uri->segment(3) == 'pdf'){
			$this->load->view('body/view_hasil_cari_taruna', $data);
			$data['header'] ='';
			$data['sidebar'] ='';
			$data['footer'] =''; 
		}elseif($this->uri->segment(3) && $this->uri->segment(3) == 'excel'){
			$this->load->view('body/view_hasil_cari_taruna', $data);
			$data['header'] ='';
			$data['sidebar'] ='';
			$data['footer'] =''; 
		}else{
			$data['body'] = "body/view_hasil_cari_taruna";
			$data['header'] = "header/header";
			$data['navbar'] = "navbar/navbar";
			$data['sidebar'] = "sidebar/sidebar";
			$data['footer'] = "footer/footer";
			$this->load->view('template', $data);
		}
	}
	
	public function index(){
		$data['status_lulus'] = array("" => "-- PILIH --", "Y" => "Lulus", "N" => "Tidak Lulus");
		
		$ListJob = $this->my_model->tampil('tb_pekerjaan')->result();
		$ArrJob[''] = '-- PILIH --';
		foreach($ListJob as $row){
			$ArrJob[$row->id_job] = $row->nama_job;
		}
		$data['ListJob'] = $ArrJob;	
		
		$ListProv = $this->my_model->tampil('provinsi')->result();
		$ArrProv[''] = '-- PILIH --';
		foreach($ListProv as $row){
			$ArrProv[$row->id] = $row->nama;
		}
		$data['ListProv'] = $ArrProv;
		
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
		
		$data['ListBidang'] = array("" => "-- PILIH --", "Reguler" => "Reguler", "Atlet" => "Atlet", "Unggulan" => "Unggulan");
		
		$data['body'] = "body/view_cari_taruna";
		$data['header'] = "header/header";
		$data['navbar'] = "navbar/navbar";
		$data['sidebar'] = "sidebar/sidebar";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>