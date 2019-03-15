<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}
	function index()
	{
		$data = "";
		$this->load->view('signin', $data);
	}
	function login_akses()
	{
		// $kirim = $this->m_login->post_to_url("https://data.uui.ac.id/auth/auth_dosen", $_POST);
		$kirim = $this->m_login->post_to_url("http://10.10.3.51/auth/auth_dosen", $_POST);
		$respon = json_decode($kirim, true);
		echo $kirim;
		if ($respon['status'] <= 0) {
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-warning' role='alert'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			username / Password salah.
			</div>");
			redirect('login');
		} else {
			$session['id_user'] = $respon['ID'];
			$session['nama'] = $respon['NAMA'];
			$session['IdProdi'] = $respon['IdProdi'];
			$this->session->set_userdata($session);
			redirect('home/index');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
 