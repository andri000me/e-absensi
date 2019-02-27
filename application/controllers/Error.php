<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Error extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
	}
	public function index(){
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "404";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>