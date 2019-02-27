<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('my_model'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('user_agent');
		$this->load->library('form_validation');
		$this->load->helper('file');
		$this->load->helper('download');
		ini_set('date.timezone', 'Asia/Jakarta');
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
		}
	}
	
	function download($filename=null){
		if($this->uri->segment(3) != '' OR $this->uri->segment(3) != NULL){
			$where = array('NAMA_FILE' => trim($this->security->xss_clean($this->uri->segment(3))));
			$GetFile = $this->my_model->cek_data("bahan_ajar", $where);
			if($GetFile->num_rows() >= 1){
				$DataGetFile = $GetFile->row_array();
				$data = file_get_contents(base_url('/upload/'.$DataGetFile['NAMA_FILE']));
				force_download($filename, $data);
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></strong> Data tidak ditemukan!</div>");
				redirect('materi');
			}
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></strong> Data tidak ditemukan!</div>");
			redirect('materi');
		}
	}
	
	function simpan(){
		//print_r($_POST);
		$judul = trim($this->security->xss_clean($this->input->post('judul')));
		$deskripsi = trim($this->security->xss_clean($this->input->post('deskripsi')));
		$sifat = trim($this->security->xss_clean($this->input->post('sifat')));

		$this->form_validation->set_rules('judul','Judul Materi Ajar','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi Materi','required');
		$uploded = date("Y-m-d H:i:s");
		if($this->form_validation->run() == true){
			if($this->input->post('IdMateri')){
				$IdMateri = trim($this->security->xss_clean($this->input->post('IdMateri')));
				$where = array('IDDOSEN'=>$this->session->userdata('id_user'), 'ID'=>$IdMateri);
				$CekFile = $this->my_model->cek_data("bahan_ajar", $where);
				if($CekFile->num_rows() >= 1){
					$DataCekFile = $CekFile->row_array();
					if($_FILES['materi']['name'] != ''){
						$config['file_name'] = $this->session->userdata('id_user')."_".$_FILES["materi"]['name'];
						$config['upload_path']          = './upload/';
						$config['allowed_types']        = 'pdf|ps|eps|doc|docx|ppt|pptx';
						$config['max_size']             = 10240;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('materi')){
							$uploadData = $this->upload->data();
							$uploadFile = $uploadData['file_name'];
							$uploadTipe = $uploadData['file_type'];
							if($uploadTipe == "application/pdf"){
								$TipeFile = "pdf";
							}elseif($uploadTipe == "application/msword" OR $uploadTipe == "application/vnd.openxmlformats-officedocument.word" OR $uploadTipe == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
								$TipeFile = "msword";
							}elseif($uploadTipe == "application/vnd.ms-powerpoint" OR $uploadTipe == "application/vnd.openxmlformats-officedocument.presentationml.presentation"){
								$TipeFile = "mspowerpoint";
							}elseif($uploadTipe == "application/postscript"){
								$TipeFile = "postscript";
							}
							unlink('./upload/'.$DataCekFile['NAMA_FILE']);
							
							//echo $uploadTipe;
							$data = array('KET_FILE'=>$deskripsi, 'JUDUL'=>$judul, 'NAMA_FILE'=>$uploadFile, 'TIPEFILE'=>$TipeFile, 'SIFAT'=>$sifat);
							if($this->my_model->update("bahan_ajar", $where, $data)){
								$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
								//redirect('materi/edit/'.$DataCekFile['ID']);
								redirect('materi');
							}else{
								$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
								//redirect('materi/edit/'.$DataCekFile['ID']);
								redirect('materi');
							}
						}else{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>File Gagal diUpload. $error</div>");
							redirect('materi');
						}
					}else{
						$data = array('KET_FILE'=>$deskripsi, 'JUDUL'=>$judul, 'SIFAT'=>$sifat);
						if($this->my_model->update("bahan_ajar", $where, $data)){
							$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil diperbaharui.</div>");
							redirect('materi/edit/'.$DataCekFile['ID']);
						}else{
							$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal diperbaharui.</div>");
							redirect('materi/edit/'.$DataCekFile['ID']);
						}
					}
				}else{
					echo "<script type=\"text/javascript\">alert('Data yang diakses tidak dikenali. Silahkan coba lagi');window.history.go(-1);</script>";
				}
			}else{
				$config['file_name'] = $this->session->userdata('id_user')."_".$_FILES["materi"]['name'];
				$config['upload_path']          = './upload/';
				$config['allowed_types']        = 'pdf|ps|eps|doc|docx|ppt|pptx';
				$config['max_size']             = 10240;
				$this->load->library('upload', $config);

				if($this->upload->do_upload('materi')){
					$uploadData = $this->upload->data();
					$uploadFile = $uploadData['file_name'];
					$uploadTipe = $uploadData['file_type'];
					if($uploadTipe == "application/pdf"){
						$TipeFile = "pdf";
					}elseif($uploadTipe == "application/msword" OR $uploadTipe == "application/vnd.openxmlformats-officedocument.word" OR $uploadTipe == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
						$TipeFile = "msword";
					}elseif($uploadTipe == "application/vnd.ms-powerpoint" OR $uploadTipe == "application/vnd.openxmlformats-officedocument.presentationml.presentation"){
						$TipeFile = "mspowerpoint";
					}elseif($uploadTipe == "application/postscript"){
						$TipeFile = "postscript";
					}
					$data = array('IDDOSEN'=>$this->session->userdata('id_user'), 'KET_FILE'=>$deskripsi, 'JUDUL'=>$judul, 'NAMA_FILE'=>$uploadFile, 'TIPEFILE'=>$TipeFile, 'SIFAT'=>$sifat, 'CREATED'=>$uploded);
					if($this->my_model->tambahdata("bahan_ajar", $data)){
						redirect('materi');
					}else{
						$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal disimpan. Silahkan dicoba lagi.</div>");
						redirect('materi');
					}
				}else{
					$error = $this->upload->display_errors();
					$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>File Gagal diUpload. $error</div>");
					redirect('materi');
				}
			}
		}else{
			echo "<script type=\"text/javascript\">alert('Semua data bertanda * harus di Isi');window.history.go(-1);</script>";
		}
	}
	
	function hapus(){
		$IDSET = $this->uri->segment(3);
		$where = array('IDSET' => $IDSET, 'IDDOSEN'=>$this->session->userdata('id_user'));
		if($this->my_model->hapus("atur_bahan_ajar", $where)){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function hapusberkas(){
		$ID = trim($this->security->xss_clean($this->uri->segment(3)));
		$where = array('ID' => $ID, 'IDDOSEN'=>$this->session->userdata('id_user'));
		$GetFile = $this->my_model->cek_data("bahan_ajar", $where);
		if($GetFile->num_rows() >= 1){
			$DataGetFile = $GetFile->row_array();
			if($this->my_model->hapus("bahan_ajar", $where)){
				unlink('./upload/'.$DataGetFile['NAMA_FILE']);
				$where = array('MATERI' => $DataGetFile['ID'], 'IDDOSEN'=>$this->session->userdata('id_user'));
				$this->my_model->hapus("atur_bahan_ajar", $where);
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-success' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data berhasil dihapus.</div>");
				redirect('materi');
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal dihapus. Coba lagi.</div>");
				redirect('materi');
			}
		}
	}
	
	public function entri(){
		$PERTEMUAN = trim($this->security->xss_clean($this->input->post('pertemuan')));
		$MATERI = trim($this->security->xss_clean($this->input->post('materi')));
		$IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
		$THSHM = trim($this->security->xss_clean($IdDos = $this->uri->segment(4)));
		$IDPRODI = trim($this->security->xss_clean($IdDos = $this->uri->segment(5)));
		$NAMAKLS = trim($this->security->xss_clean($IdDos = $this->uri->segment(6)));
		$SEMESTER = trim($this->security->xss_clean($IdDos = $this->uri->segment(7)));
		$CREATED = date("Y-m-d H:i:s", time());
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'PERTEMUAN' => $PERTEMUAN, 'MATERI' => $MATERI);
		$GetBahanAjar = $this->my_model->cek_data("atur_bahan_ajar", $where);
		if($GetBahanAjar->num_rows() >= 1){
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Bahan Ajar ini sudah ditambahkan di pertemuan ini. Silahkan pilih bahan ajar yang lain..!</div>");
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$data = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'PERTEMUAN' => $PERTEMUAN, 'MATERI' => $MATERI, 'CREATED' => $CREATED);
			if($this->my_model->tambahdata("atur_bahan_ajar", $data)){
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-info' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Bahan Ajar ini berhasil di tambah ke pertemuan ini..!</div>");
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Bahan Ajar ini gagal di tambah ke pertemuan ini..!</div>");
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function edit(){
		$IdMateri = trim($this->security->xss_clean($this->uri->segment(3)));
		$where = array('ID' => $IdMateri, 'IDDOSEN' => $this->session->userdata('id_user'));
		$CekEdit= $this->my_model->cek_data("bahan_ajar", $where);
		if($CekEdit->num_rows() >= 1){
			$data['DataEdit'] = $CekEdit->result();
		}
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$CekMateri= $this->my_model->cek_data("bahan_ajar", $where);
		if($CekMateri->num_rows() >= 1){
			$data['DataMateri'] = $CekMateri->result();
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Bahan Ajar Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
		}
		$data['SifatDokumen'] = array("1" => "Open/Publik", "0" => "Private/Khusus Mahasiswa");
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_bahanajar";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
	
	public function index(){
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$CekProfil= $this->my_model->cek_data("profil_dosen", $where);
		if($CekProfil->num_rows() >= 1){
			$data['DataProfil'] = $CekProfil->result();
		}else{
			$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Bahan Ajar Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
		}
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_profil_dosen";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}
?>