<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agama extends CI_Controller {
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
		$id_agama = trim($this->security->xss_clean($this->input->post('id_agama')));
		$nama_agama = trim($this->security->xss_clean($this->input->post('nama_agama')));
		$this->form_validation->set_rules('nama_agama','Nama Agama','required');
		$this->form_validation->set_rules('id_agama','Id Agama','required');
		if($this->form_validation->run() == true){
			$data = array('nama_agama'=>$nama_agama);
			$where = array('id_agama'=>$id_agama);
			if($this->my_model->update("tb_agama", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('agama/edit/'.$id_agama);
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.
				</div>");
				redirect('agama/edit/'.$id_agama);
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
		
	}
	
	function simpan(){
		$this->load->library('form_validation');
		$nama_agama = trim($this->security->xss_clean($this->input->post('nama_agama')));
		$this->form_validation->set_rules('nama_agama','Nama Agama','required');
		if($this->form_validation->run() == true){
			$data = array('nama_agama'=>$nama_agama);
			if($this->my_model->tambahdata("tb_agama", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disimpan.</div>");
				redirect('agama/entri');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan.</div>");
				redirect('agama/entri');
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}		
	}
	
	function hapus(){
		$id_agama = $this->uri->segment(3);
		$where = array('id_agama' => $id_agama);
		if($this->my_model->hapus("tb_agama", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect('agama');
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect('agama');
		}
	}
	
	public function entri(){
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_agama_entri";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function edit(){
		$id_agama = $this->uri->segment(3);
		$where = array('id_agama' => $id_agama);
		$data['CekAgama'] = $this->my_model->cek_data("tb_agama", $where)->result();
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_agama_edit";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$this->load->library('pagination');
		$jumlah_data = $this->my_model->tampil('tb_agama')->num_rows();
		$config['base_url'] = base_url().'agama/index';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['data_agama'] = $this->my_model->lihat_agama($config['per_page'],$from);
	
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_agama";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>