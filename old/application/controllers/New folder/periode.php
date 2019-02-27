<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Periode extends CI_Controller {
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
		$id_periode = trim($this->security->xss_clean($this->input->post('id_periode')));
		$nama_periode = trim($this->security->xss_clean($this->input->post('nama_periode')));
		$status_periode = trim($this->security->xss_clean($this->input->post('status_periode')));
		$this->form_validation->set_rules('nama_periode','Nama Periode','required');
		$this->form_validation->set_rules('id_periode','Id Periode','required');
		if($this->form_validation->run() == true){
			if($status_periode == 'Y'){
				$data = array('status_periode'=>'N');
				$this->my_model->update("tb_periode", $where=null, $data);
			}
			$data = array('nama_periode'=>$nama_periode, 'status_periode'=>$status_periode);
			$where = array('id_periode'=>$id_periode);
			if($this->my_model->update("tb_periode", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('periode/edit/'.$id_periode);
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.
				</div>");
				redirect('periode/edit/'.$id_periode);
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
		
	}
	
	function simpan(){
		$this->load->library('form_validation');
		$nama_periode = trim($this->security->xss_clean($this->input->post('nama_periode')));
		$status_periode = trim($this->security->xss_clean($this->input->post('status_periode')));
		$this->form_validation->set_rules('nama_periode','Nama Periode','required');
		$waktuSkr = date("Y-m-d H:i:s");
		if($this->form_validation->run() == true){
			if($status_periode == 'Y'){
				$data = array('status_periode'=>'N');
				$this->my_model->update("tb_periode", $where=null, $data);
			}
			$data = array('nama_periode'=>$nama_periode, 'status_periode'=>$status_periode, 'created'=>$waktuSkr);
			if($this->my_model->tambahdata("tb_periode", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disimpan.</div>");
				redirect('periode/entri');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan.</div>");
				redirect('periode/entri');
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}		
	}
	
	function hapus(){
		$id_periode = $this->uri->segment(3);
		$where = array('id_periode' => $id_periode);
		if($this->my_model->hapus("tb_periode", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect('periode');
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect('periode');
		}
	}
	
	public function entri(){
		$data['list_periode'] = array("" => "-- PILIH --", "Y" => "Aktif", "N" => "Tidak Aktif");
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_periode_entri";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function edit(){
		$id_periode = $this->uri->segment(3);
		$data['list_periode'] = array("" => "-- PILIH --", "Y" => "Aktif", "N" => "Tidak Aktif");
		$where = array('id_periode' => $id_periode);
		$data['CekPeriode'] = $this->my_model->cek_data("tb_periode", $where)->result();
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_periode_edit";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$this->load->library('pagination');
		$jumlah_data = $this->my_model->tampil('tb_periode')->num_rows();
		$config['base_url'] = base_url().'periode/index';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['data_periode'] = $this->my_model->lihat_periode($config['per_page'],$from);
	
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_periode";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>