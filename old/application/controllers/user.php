<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('m_user'); 
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></strong> Silahkan login terlebih dahulu.</div>");
			redirect('login');
		}  
	}
	
	function update(){
		$this->load->library('form_validation');
		$id_user = trim($this->security->xss_clean($this->input->post('id_user')));
		$nama = trim($this->security->xss_clean($this->input->post('nama')));
		$uname = trim($this->security->xss_clean($this->input->post('uname')));
		$upass = trim($this->security->xss_clean($this->input->post('upass')));
		//$level = trim($this->security->xss_clean($this->input->post('leveluser')));
		$level = "Admin";
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('uname','Username User','required');
		$this->form_validation->set_rules('id_user','Id User','required');
		//$this->form_validation->set_rules('leveluser','Level User','required');
		if($this->form_validation->run() == true){
			if($upass != ''){
				$data = array('nama'=>$nama, 'uname'=>$uname, 'upass'=>password_hash($upass, PASSWORD_DEFAULT), 'level'=>$level);
			}else{
				$data = array('nama'=>$nama, 'uname'=>$uname, 'level'=>$level);
			}
			$where = array('id_user'=>$id_user);
			if($this->m_user->updatedata("tb_user", $where, $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
				redirect('User/edit/'.$id_user);
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Data Gagal diperbaharui.
				</div>");
				redirect('User/edit/'.$id_User);
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
		
	}
	
	function simpan(){
		$this->load->library('form_validation');
		$nama = trim($this->security->xss_clean($this->input->post('nama')));
		$uname = trim($this->security->xss_clean($this->input->post('uname')));
		$upass = trim($this->security->xss_clean($this->input->post('upass')));
		//$level = trim($this->security->xss_clean($this->input->post('leveluser')));
		$level = "Admin";
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('uname','Username User','required');
		$this->form_validation->set_rules('upass','Password User','required');
		//$this->form_validation->set_rules('leveluser','Level User','required');
		$waktuSkr = date("Y-m-d H:i:s");
		if($this->form_validation->run() == true){
			$data = array('nama'=>$nama, 'uname'=>$uname, 'upass'=>password_hash($upass, PASSWORD_DEFAULT), 'level'=>$level, 'created'=>$waktuSkr);
			if($this->m_user->tambahdata("tb_user", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil disimpan.</div>");
				redirect('User/entri');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan.</div>");
				redirect('User/entri');
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}		
	}
	
	function hapus(){
		$idUser = $this->uri->segment(3);
		$where = array('id_user' => $idUser);
		if($this->m_user->hapusdata("tb_user", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect('user');
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect('user');
		}
	}
	
	public function entri(){
		$data['dropdown_level'] = array("" => "-- PILIH --", "Admin" => "Admin", "Pimpinan" => "Pimpinan");		
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_user_entri";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function edit(){
		$idUser = $this->uri->segment(3);
		$where = array('id_user' => $idUser);
		$data['CekUser'] = $this->m_user->cek_data("tb_user", $where)->result();
		$data['dropdown_level'] = array("" => "-- PILIH --", "Admin" => "Admin", "Pimpinan" => "Pimpinan");
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_user_edit";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$this->load->library('pagination');
		$jumlah_data = $this->m_user->jumlah_user();
		$config['base_url'] = base_url().'user/index';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		$data['data_user'] = $this->m_user->lihat_user($config['per_page'],$from);
	
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_user";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>