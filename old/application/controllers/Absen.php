<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller
{
  function __construct(){
		parent::__construct();
		$this->load->model('my_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('user_agent');
		ini_set('date.timezone', 'Asia/Jakarta');
		if(!$this->session->userdata('id_user')){
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
    }
  }

  public function view(){
    $thnAjar = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
    $where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar);
    $this->db->order_by('NAMAMK', 'ASC');
    $CekMakul= $this->my_model->cek_data("makul_dosen", $where);
    if($CekMakul->num_rows() >= 1){
      $thn_ajr = substr($thnAjar, 0, -1);
      $smt = substr($thnAjar, -1);
      if($smt % 2 != 0){
        $smt_show = "GANJIL";
      }else{
        $smt_show = "GENAP";
      }
      $data['thnAjarInt'] = $thnAjar;
      $data['thnAjar'] = $smt_show." ".$thn_ajr;
      $data['data_mk'] = $CekMakul->result();
    }else{
      $this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
    }
    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_makul_thsm";
    $data['footer'] = "footer/footer";
    $this->load->view('template', $data);
  }

  public function simpan(){
    $pertemuan = trim($this->security->xss_clean($this->uri->segment(3)));
    foreach($_POST as $field => $nilai){
        //echo $field." - ". $nilai."<br/>";
        $ket = trim($this->security->xss_clean($this->input->post($field)));
        echo $field."<br/>";
    }
    echo $pertemuan;
    //print_r($_POST);
  }
  public function detail(){
    $IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
    $thnAjar = trim($this->security->xss_clean($IdDos = $this->uri->segment(4)));
    $IDPRODI = trim($this->security->xss_clean($IdDos = $this->uri->segment(5)));
    $NAMAKLS = trim($this->security->xss_clean($IdDos = $this->uri->segment(6)));
    $SEMESTER = trim($this->security->xss_clean($IdDos = $this->uri->segment(7)));
    $where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
    $CekMakul= $this->my_model->cek_data("makul_dosen", $where);
    if($CekMakul->num_rows() >= 1){
      $thn_ajr = substr($thnAjar, 0, -1);
      $smt = substr($thnAjar, -1);
      if($smt % 2 != 0){
        $smt_show = "GANJIL";
      }else{
        $smt_show = "GENAP";
      }
      $data['thnAjar'] = $smt_show." ".$thn_ajr;
      $data['thnAjarInt'] = $thnAjar;
      //print_r($CekMakul->result());

      $data['data_mk'] = $CekMakul->result();
    }else{
      $this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan ulangi kembali..!</div>");
    }

    $ArrPertemuan[''] = '-- PILIH --';
    for($a=1; $a<=16; $a++){
      $ArrPertemuan[$a] = "Pertemuan ".$a;
    }
    $data['Pertemuan'] = $ArrPertemuan;

    //panggil data mahasiswa dan oper ke form absen view_mk_absen
    $where = array('IDMAKUL' => $IDMAKUL);
    $cekmhs= $this->my_model->cek_data("absen_mhs",$where);
    if($cekmhs->num_rows() >= 1){
      // print_r($cekmhs->result());

      $data['data_mhs'] = $cekmhs->result();
    }else{
      $this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan ulangi kembali..!</div>");
    }

    // if($this->input->get('pertemuan')){
    //   $pertemuan = trim($this->security->xss_clean($this->input->get('pertemuan')));
    //   $where = array('a.IDDOSEN' => $this->session->userdata('id_user'), 'a.THSHM' => $thnAjar, 'a.IDPRODI' => $IDPRODI, 'a.IDMAKUL' => $IDMAKUL, 'a.NAMAKLS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER, 'a.PERTEMUAN' => $pertemuan);
    //   $this->db->join('bahan_ajar b', 'b.ID = a.MATERI', 'join');
    //   $GetBahanAjar = $this->my_model->cek_data("atur_bahan_ajar a", $where);
    //   if($GetBahanAjar->num_rows() >= 1){
    //     $data['GetBahanAjar'] = $GetBahanAjar->result();
    //   }
    // }

    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_mk_absen";
    $data['footer'] = "footer/footer";
    $this->load->view('template', $data);
  }


  public function index(){
    $this->db->select('THSHM');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$this->db->limit(1);
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$LasThnAjar= $this->my_model->cek_data("makul_dosen", $where);
		if($LasThnAjar->num_rows() >= 1){
			$showLasThnAjar= $LasThnAjar->row();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $showLasThnAjar->THSHM);
			$this->db->order_by('NAMAMK', 'ASC');
			$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
			if($CekMakul->num_rows() >= 1){
				$thn_ajr = substr($showLasThnAjar->THSHM, 0, -1);
				$smt = substr($showLasThnAjar->THSHM, -1);
				if($smt % 2 != 0){
					$smt_show = "GANJIL";
				}else{
					$smt_show = "GENAP";
				}
				$data['thnAjarInt'] = $showLasThnAjar->THSHM;
				$data['thnAjar'] = $smt_show." ".$thn_ajr;
				$data['data_mk'] = $CekMakul->result();
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
			}
		}
		$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_absen_mahasiswa";
		$data['footer'] = "footer/footer";
		$this->load->view('template', $data);
	}
}

 ?>
