<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dikum extends CI_Controller {
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
		$id_dikum = trim($this->security->xss_clean($this->input->post('id_dikum')));
		$nama_dikum = trim($this->security->xss_clean($this->input->post('nama_dikum')));
		$this->form_validation->set_rules('nama_dikum','Nama Dikum','required');
		$this->form_validation->set_rules('id_dikum','Id Dikum','required');
		if($this->form_validation->run() == true){
			$data = array('nama_dikum'=>$nama_dikum);
			$where = array('id_dikum'=>$id_dikum);
			if($this->my_model->update("tb_dikum", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('dikum/edit/'.$id_dikum);
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.
				</div>");
				redirect('dikum/edit/'.$id_dikum);
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
		
	}
	
	function simpan(){
		$this->load->library('form_validation');
		$nama_dikum = trim($this->security->xss_clean($this->input->post('nama_dikum')));
		$this->form_validation->set_rules('nama_dikum','Nama Dikum','required');
		$waktuSkr = date("Y-m-d H:i:s");
		if($this->form_validation->run() == true){
			$data = array('nama_dikum'=>$nama_dikum, 'created'=>$waktuSkr);
			if($this->my_model->tambahdata("tb_dikum", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disimpan.</div>");
				redirect('dikum/entri');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan.</div>");
				redirect('dikum/entri');
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}		
	}
	
	function hapus(){
		$id_dikum = $this->uri->segment(3);
		$where = array('id_dikum' => $id_dikum);
		if($this->my_model->hapus("tb_dikum", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect('dikum');
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect('dikum');
		}
	}
	
	public function entri(){
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_dikum_entri";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function edit(){
		$id_dikum = $this->uri->segment(3);
		$where = array('id_dikum' => $id_dikum);
		$data['CekDikum'] = $this->my_model->cek_data("tb_dikum", $where)->result();
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_dikum_edit";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$this->load->library('pagination');
		$jumlah_data = $this->my_model->tampil('tb_dikum')->num_rows();
		$config['base_url'] = base_url().'dikum/index';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['data_dikum'] = $this->my_model->lihat_dikum($config['per_page'],$from);
	
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_dikum";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>