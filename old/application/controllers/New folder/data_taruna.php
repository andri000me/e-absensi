<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_taruna extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		ini_set('date.timezone', 'Asia/Jakarta');
		$this->load->model('my_model'); 
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
		}  
	}
	function download($filename = NULL){
		if($this->uri->segment(3) != '' OR $this->uri->segment(3) != NULL){
			// load download helder
			$this->load->helper('download');
			// read file contents
			$data = file_get_contents(base_url('/upload/'.$filename));
			force_download($filename, $data);
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></strong> Halaman tidak ditemukan!</div>");
			redirect('data_brg');
		}
	}
	
	function view(){
		$id_taruna = $this->uri->segment(3);
		$where = array('a.id_taruna' => $id_taruna);
		$CekPeserta = $this->my_model->cek_detail($where);
		if($this->uri->segment(4) && $this->uri->segment(4) == 'pdf'){
			$data['header'] ='';
			$data['sidebar'] ='';
			$data['footer'] ='';
			if($CekPeserta->num_rows() >= 1 OR $id_taruna != ''){
				$data['TampilPeserta'] = $CekPeserta->result();
				$this->load->view('body/view_detail_peserta', $data);
			}else{
				$data['body'] = "404";
			} 
		}else{
			if($CekPeserta->num_rows() >= 1 OR $id_taruna != ''){
				$data['TampilPeserta'] = $CekPeserta->result();
				$data['body'] = "body/view_detail_peserta";
			}else{
				$data['body'] = "404";
			}
			$data['header'] = "header/header";
			$data['navbar'] = "navbar/navbar";
			$data['sidebar'] = "sidebar/sidebar";
			$data['footer'] = "footer/footer";
			$this->load->view('template', $data);
		}
	}
	
	public function index(){
		$this->load->library('pagination');
		$where = array('status_periode'=> 'Y');
		$CekData = $this->my_model->cek_data("tb_periode", $where);
		$AmbilData = $CekData->row();
		$data['nama_periode'] = $AmbilData->nama_periode;
		$where = array('id_periode'=> $AmbilData->id_periode);		
		$jumlah_data = $this->my_model->cek_data('tb_taruna', $where)->num_rows();
		$config['base_url'] = base_url().'data_taruna/index';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		//$config['uri_segment'] = 3;
		$config['num_links'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['data_taruna'] = $this->my_model->lihat_peserta($config['per_page'], $from, $where);
	
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_data_taruna";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>