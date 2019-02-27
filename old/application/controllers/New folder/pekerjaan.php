<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pekerjaan extends CI_Controller {
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
		$id_job = trim($this->security->xss_clean($this->input->post('id_job')));
		$nama_job = trim($this->security->xss_clean($this->input->post('nama_job')));
		$this->form_validation->set_rules('nama_job','Nama Pekerjaan','required');
		$this->form_validation->set_rules('id_job','Id Pekerjaan','required');
		if($this->form_validation->run() == true){
			$data = array('nama_job'=>$nama_job);
			$where = array('id_job'=>$id_job);
			if($this->my_model->update("tb_pekerjaan", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('pekerjaan/edit/'.$id_job);
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.
				</div>");
				redirect('pekerjaan/edit/'.$id_job);
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
		
	}
	
	function simpan(){
		$this->load->library('form_validation');
		$nama_job = trim($this->security->xss_clean($this->input->post('nama_job')));
		$this->form_validation->set_rules('nama_job','Nama Pekerjaan','required');
		if($this->form_validation->run() == true){
			$data = array('nama_job'=>$nama_job);
			if($this->my_model->tambahdata("tb_pekerjaan", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disimpan.</div>");
				redirect('pekerjaan/entri');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan.</div>");
				redirect('pekerjaan/entri');
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}		
	}
	
	function hapus(){
		$id_job = $this->uri->segment(3);
		$where = array('id_job' => $id_job);
		if($this->my_model->hapus("tb_pekerjaan", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect('pekerjaan');
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect('pekerjaan');
		}
	}
	
	public function entri(){
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_pekerjaan_entri";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function edit(){
		$id_job = $this->uri->segment(3);
		$where = array('id_job' => $id_job);
		$data['CekPekerjaan'] = $this->my_model->cek_data("tb_pekerjaan", $where)->result();
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_pekerjaan_edit";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$this->load->library('pagination');
		$jumlah_data = $this->my_model->tampil('tb_pekerjaan')->num_rows();
		$config['base_url'] = base_url().'pekerjaan/index';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['data_pekerjaan'] = $this->my_model->lihat_pekerjaan($config['per_page'],$from);
	
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_pekerjaan";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>