<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('m_login');
    }
	function index(){
		$data = "";
		$this->load->view('signin', $data);
	}
	function login_akses(){
		$kirim = $this->m_login->post_to_url("http://data.uui.ac.id/auth/auth_dosen", $_POST);
		$respon = json_decode($kirim, true);
		if($respon['status'] <= 0){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			username / Password salah.
			</div>");
			redirect('login');
		}else{
			$session['id_user'] = $respon['ID'];
			$session['nama'] = $respon['NAMA'];
			$session['IdProdi'] = $respon['IdProdi'];
			$this->session->set_userdata($session);
			redirect('home');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}?>
