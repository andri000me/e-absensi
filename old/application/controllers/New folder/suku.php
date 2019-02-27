<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Suku extends CI_Controller {
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
	
	function update(){
		$this->load->library('form_validation');
		$id_suku = trim($this->security->xss_clean($this->input->post('id_suku')));
		$nama_suku = trim($this->security->xss_clean($this->input->post('nama_suku')));
		$this->form_validation->set_rules('nama_suku','Nama Suku','required');
		$this->form_validation->set_rules('id_suku','Id Suku','required');
		if($this->form_validation->run() == true){
			$data = array('nama_suku'=>$nama_suku);
			$where = array('id_suku'=>$id_suku);
			if($this->my_model->update("tb_suku", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('suku/edit/'.$id_suku);
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.
				</div>");
				redirect('suku/edit/'.$id_suku);
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
		
	}
	
	function simpan(){
		$this->load->library('form_validation');
		$nama_suku = trim($this->security->xss_clean($this->input->post('nama_suku')));
		$this->form_validation->set_rules('nama_suku','Nama Suku','required');
		if($this->form_validation->run() == true){
			$data = array('nama_suku'=>$nama_suku);
			if($this->my_model->tambahdata("tb_suku", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disimpan.</div>");
				redirect('suku/entri');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan.</div>");
				redirect('suku/entri');
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}		
	}
	
	function hapus(){
		$id_suku = $this->uri->segment(3);
		$where = array('id_suku' => $id_suku);
		if($this->my_model->hapus("tb_suku", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect('suku');
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect('suku');
		}
	}
	
	public function entri(){
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_suku_entri";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function edit(){
		$id_suku = $this->uri->segment(3);
		$where = array('id_suku' => $id_suku);
		$data['CekSuku'] = $this->my_model->cek_data("tb_suku", $where)->result();
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_suku_edit";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$this->load->library('pagination');
		$jumlah_data = $this->my_model->tampil('tb_suku')->num_rows();
		$config['base_url'] = base_url().'suku/index';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['data_suku'] = $this->my_model->lihat_suku($config['per_page'],$from);
	
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_suku";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>