<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publik extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('my_model');
		$this->load->helper('download');
		$this->load->helper(array('url'));
		$this->load->library('pagination');
		 $this->load->helper('form');
		ini_set('date.timezone', 'Asia/Jakarta');
	}
	function download($filename=null){
		if($this->uri->segment(3) != '' OR $this->uri->segment(3) != NULL){
			$where = array('NAMA_FILE' => trim($this->security->xss_clean($this->uri->segment(3))));
			$GetFile = $this->my_model->cek_data("bahan_ajar", $where);
			if($GetFile->num_rows() >= 1){
				$DataGetFile = $GetFile->row_array();
				//$data = file_get_contents(base_url('/upload/'.$DataGetFile['NAMA_FILE']));
				$data= $this->my_model->fetchUrl(base_url('/upload/'.$DataGetFile['NAMA_FILE']));
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
	public function dosen(){
		if($this->uri->segment(3) OR $this->uri->segment(3)=="0"){
			$IDDOSEN = trim($this->security->xss_clean($this->uri->segment(3)));
			$where = array('IDDOSEN' => $IDDOSEN);
			$GetListDos = $this->my_model->cek_data("profil_dosen", $where);
			if($GetListDos->num_rows() >= 1){
				$data['GetDetailDos'] = $GetListDos->result();

				$this->db->select('THSHM');
				$this->db->group_by('THSHM');
				$this->db->order_by('THSHM', 'DESC');
				$this->db->limit(1);
				$where = array('IDDOSEN' => $IDDOSEN);
				$LasThnAjar= $this->my_model->cek_data("makul_dosen", $where);
				if($LasThnAjar->num_rows() >= 1){
					$showLasThnAjar= $LasThnAjar->row();
					$where = array('IDDOSEN' => $IDDOSEN, 'THSHM' => $showLasThnAjar->THSHM);
					$this->db->order_by('NAMAMK', 'ASC');
					$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
					if($CekMakul->num_rows() >= 1){
						$thn_ajr = substr($showLasThnAjar->THSHM, 0, -1);
						$smt = substr($showLasThnAjar->THSHM, -1);
						if($smt % 2 != 0){
							$smt_show = "Ganjil";
						}else{
							$smt_show = "Genap";
						}
						$data['thnAjarInt'] = $showLasThnAjar->THSHM;
						$data['thnAjar'] = $smt_show." ".$thn_ajr;
						$data['data_mk'] = $CekMakul->result();
					}
					if($this->uri->segment(4) && $this->uri->segment(5) && $this->uri->segment(6) && $this->uri->segment(7) && $this->uri->segment(8)){
						$IDMAKUL = trim($this->security->xss_clean($this->uri->segment(4)));
						$THSHM = trim($this->security->xss_clean($this->uri->segment(5)));
						$IDPRODI = trim($this->security->xss_clean($this->uri->segment(6)));
						$NAMAKLS = trim($this->security->xss_clean($this->uri->segment(7)));
						$SEMESTER = trim($this->security->xss_clean($this->uri->segment(8)));
						$where = array('IDDOSEN' => $IDDOSEN, 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
						$CekMakulDetail= $this->my_model->cek_data("makul_dosen", $where);
						if($CekMakulDetail->num_rows() >= 1){
							$data['data_mk_detail'] = $CekMakulDetail->result();
						}
					}
				}
			}
		}else{
			$this->db->order_by('NAMADOS','ASC');
			$GetListDos = $this->my_model->tampil("profil_dosen");
			if($GetListDos->num_rows() >= 1){
				$data['GetListDos'] = $GetListDos->result();
			}
		}

		// statistik disini
		$IDDOSEN = trim($this->security->xss_clean($this->uri->segment(3)));
		$IDMAKUL = trim($this->security->xss_clean($this->uri->segment(4)));
		$THSHM = trim($this->security->xss_clean($this->uri->segment(5)));
		$IDPRODI = trim($this->security->xss_clean($this->uri->segment(6)));
		$NAMAKLS = trim($this->security->xss_clean($this->uri->segment(7)));
		$SEMESTER = trim($this->security->xss_clean($this->uri->segment(8)));

		// $this->db->group_by('PERTEMUAN');
		$where = array('THNSM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$statikAbsen = $this->my_model->cek_data("absen_dosen", $where);
		if($statikAbsen->num_rows() >= 1){
			$data['jmlpertemuan'] = $statikAbsen->result();
		}
		// $wheremhs = array('THNSM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$this->db->group_by('IDMAHASISWA');
		$whereprodi = array('IDPRODI'=>$IDPRODI, 'THNSM' => $THSHM, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$jmlmhs = $this->my_model->cek_data("absen_mhs", $whereprodi);
		if($jmlmhs->num_rows() >= 1){
			$data['jmlmhsw'] = $jmlmhs->result();
		}

		$whereStatH = array('THNSM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'ABSENSI' => "H");
		$statH = $this->my_model->cek_data("absen_mhs", $whereStatH);
		if($statH->num_rows() >= 1){
			$hasil = $statH->result();
			// echo "Pertemuan ke - ". $pertemuan. " Sebanyak ". count($hasil)."<br>"
			$hasil_Absen = count($hasil);
			$data['hadirH'] = $hasil_Absen;
		}

		$whereStatA = array('THNSM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'ABSENSI' => "A");
		$statA = $this->my_model->cek_data("absen_mhs", $whereStatA);
		if($statA->num_rows() >= 1){
			$hasilA = $statA->result();
			// echo "Pertemuan ke - ". $pertemuan. " Sebanyak ". count($hasil)."<br>"
			$hasil_AbsenA = count($hasilA);
			$data['hadirA'] = $hasil_AbsenA;
		}

		$whereStatS = array('THNSM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'ABSENSI' => "S");
		$statS = $this->my_model->cek_data("absen_mhs", $whereStatS);
		if($statS->num_rows() >= 1){
			$hasilS = $statS->result();
			// echo "Pertemuan ke - ". $pertemuan. " Sebanyak ". count($hasil)."<br>"
			$hasil_AbsenS = count($hasilS);
			$data['hadirS'] = $hasil_AbsenS;
		}

		$whereStatI = array('THNSM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER, 'ABSENSI' => "I");
		$statI = $this->my_model->cek_data("absen_mhs", $whereStatI);
		if($statI->num_rows() >= 1){
			$hasilI = $statI->result();
			// echo "Pertemuan ke - ". $pertemuan. " Sebanyak ". count($hasil)."<br>"
			$hasil_AbsenI = count($hasilI);
			$data['hadirI'] = $hasil_AbsenI;
		}


		$this->db->select('THSHM');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$this->db->limit(1);
		// $where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$LasThnAjar= $this->my_model->cek_data("makul_dosen", $where);
		if($LasThnAjar->num_rows() >= 1){
			$showLasThnAjar= $LasThnAjar->row();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
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
				$data['data_mkterkini'] = $CekMakul->result();
			}else{
				$this->session->set_flashdata("msg", "<br/><div class='alert bg-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
			}
		}

		//disini absen mahasiswa

		$where = array('a.IDMAKUL' => $IDMAKUL, 'a.THNSM' => $THSHM, 'a.IDPRODI' => $IDPRODI, 'a.KELAS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER);
		$this->db->group_by('a.IDMAHASISWA');
		$this->db->join('mhs_course b', 'b.IDMAHASISWA = a.IDMAHASISWA');
		// $this->db->order_by('a.IDMAHASISWA');
		$CekAbsMhs = $this->my_model->cek_data("absen_mhs a", $where);
		if($CekAbsMhs->num_rows() >= 1){
			$data['absen_mhsw'] = $CekAbsMhs->result();
			$this->db->select('a.IDMAHASISWA, a.PERTEMUAN, a.ABSENSI');
			$where = array('a.IDMAKUL' => $IDMAKUL, 'a.THNSM' => $THSHM, 'a.IDPRODI' => $IDPRODI, 'a.KELAS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER);
			$this->db->join('mhs_course b', 'b.IDMAHASISWA = a.IDMAHASISWA');
			$ListAbsen = $this->my_model->cek_data("absen_mhs a", $where);
			if($ListAbsen->num_rows() >= 1){
				foreach($ListAbsen->result() as $value){
					$arr_list_absen[$value->IDMAHASISWA.'_'.$value->PERTEMUAN] = $value->ABSENSI;
					// print_r($arr_list_absen);
				}
				$data['list_absen'] = $arr_list_absen;
			}
		}

		$this->load->view('publik', $data);
	}


	public function getmateri(){
		$IDDOSEN = trim($this->security->xss_clean($this->input->get('IDDOSEN')));
		$THSHM = trim($this->security->xss_clean($this->input->get('THNSM')));
		$IDPRODI = trim($this->security->xss_clean($this->input->get('IDPRODI')));
		$IDMAKUL = trim($this->security->xss_clean($this->input->get('IDMAKUL')));
		$NAMAKLS = trim($this->security->xss_clean($this->input->get('KELAS')));
		$SEMESTER = trim($this->security->xss_clean($this->input->get('SEMESTER')));
		if($this->input->get('PERTEMUAN')){
			$PERTEMUAN = trim($this->security->xss_clean($this->input->get('PERTEMUAN')));
			$where = array('a.IDDOSEN' => $IDDOSEN, 'a.THSHM' => $THSHM, 'a.IDPRODI' => $IDPRODI, 'a.IDMAKUL' => $IDMAKUL, 'a.NAMAKLS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER, 'a.PERTEMUAN' => $PERTEMUAN);
		}else{
			$this->db->order_by('a.PERTEMUAN','ASC');
			$where = array('a.IDDOSEN' => $IDDOSEN, 'a.THSHM' => $THSHM, 'a.IDPRODI' => $IDPRODI, 'a.IDMAKUL' => $IDMAKUL, 'a.NAMAKLS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER);
		}
		$this->db->join('bahan_ajar b', 'b.ID = a.MATERI', 'join');
		$GetMateri = $this->my_model->cek_data("atur_bahan_ajar a", $where);
		if($GetMateri->num_rows() >= 1){
			$showGetMateri= $GetMateri->result();
			echo json_encode($showGetMateri);
		}else{
			$dumpArray = array("status" => 0, "message" => "Data Tidak di Termukan");
			echo json_encode($dumpArray);
		}
	}
	public function index(){
		// $jumlah_data = $this->my_model->tampil("atur_bahan_ajar")->num_rows();
		// $config['base_url'] = base_url().'publik/index';
		// $config['total_rows'] = $jumlah_data;
		// $config['per_page'] = 6;
		// $config['num_links'] = 10;
		// $from = $this->uri->segment(3);
		// $this->pagination->initialize($config);
		// $this->db->order_by('a.CREATED','DESC');
		// $this->db->join('bahan_ajar b', 'b.ID = a.MATERI', 'join');
		// $this->db->join('profil_dosen c', 'c.IDDOSEN = a.IDDOSEN', 'join');
		// $this->db->group_by('a.IDDOSEN, a.THSHM, a.IDPRODI, a.IDMAKUL, a.NAMAKLS, a.SEMESTER, a.PERTEMUAN');
		// $GetBahanAjar = $this->my_model->tampil_page($config['per_page'], $from);
		// if($jumlah_data >= 1){
		// 	$data['GetBahanAjar'] = $GetBahanAjar->result();
		// 	foreach($data['GetBahanAjar'] as $value){
		// 		$DataMk1 = $GetBahanAjar->row_array();
		// 		$where = array('IDDOSEN' => $value->IDDOSEN, 'THSHM' => $value->THSHM, 'IDPRODI' => $value->IDPRODI, 'IDMAKUL' => $value->IDMAKUL, 'NAMAKLS' => $value->NAMAKLS, 'SEMESTER' => $value->SEMESTER);
		// 		$NamaMk = $this->my_model->cek_data("makul_dosen", $where);
		// 		$DataMk = $NamaMk->row_array();
		// 		$ShowMk = $DataMk['NAMAMK'].'-'.$DataMk['NMPSTMSPST'];
		// 		$ArrMk[$ShowMk] = $value->IDMAKUL;
		// 	}
		// 	$data['ListMk'] = $ArrMk;
		// }else{
		// 	$data['ListMk'] = '';
		// }

		if($this->uri->segment(3) OR $this->uri->segment(3)=="0"){
			$IDDOSEN = trim($this->security->xss_clean($this->uri->segment(3)));
			$where = array('IDDOSEN' => $IDDOSEN);
			$GetListDos = $this->my_model->cek_data("profil_dosen", $where);
			if($GetListDos->num_rows() >= 1){
				$data['GetDetailDos'] = $GetListDos->result();
				$this->db->select('THSHM');
				$this->db->group_by('THSHM');
				$this->db->order_by('THSHM', 'DESC');
				$this->db->limit(1);
				$where = array('IDDOSEN' => $IDDOSEN);
				$LasThnAjar= $this->my_model->cek_data("makul_dosen", $where);
				if($LasThnAjar->num_rows() >= 1){
					$showLasThnAjar= $LasThnAjar->row();
					$where = array('IDDOSEN' => $IDDOSEN, 'THSHM' => $showLasThnAjar->THSHM);
					$this->db->order_by('NAMAMK', 'ASC');
					$CekMakul= $this->my_model->cek_data("makul_dosen", $where);
					if($CekMakul->num_rows() >= 1){
						$thn_ajr = substr($showLasThnAjar->THSHM, 0, -1);
						$smt = substr($showLasThnAjar->THSHM, -1);
						if($smt % 2 != 0){
							$smt_show = "Ganjil";
						}else{
							$smt_show = "Genap";
						}
						$data['thnAjarInt'] = $showLasThnAjar->THSHM;
						$data['thnAjar'] = $smt_show." ".$thn_ajr;
						$data['data_mk'] = $CekMakul->result();

					}
					if($this->uri->segment(4) && $this->uri->segment(5) && $this->uri->segment(6) && $this->uri->segment(7) && $this->uri->segment(8)){
						$THSHM = trim($this->security->xss_clean($this->uri->segment(5)));
						$IDPRODI = trim($this->security->xss_clean($this->uri->segment(6)));
						$IDMAKUL = trim($this->security->xss_clean($this->uri->segment(4)));
						$NAMAKLS = trim($this->security->xss_clean($this->uri->segment(7)));
						$SEMESTER = trim($this->security->xss_clean($this->uri->segment(8)));
						$where = array('IDDOSEN' => $IDDOSEN, 'THSHM' => $THSHM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
						$CekMakulDetail= $this->my_model->cek_data("makul_dosen", $where);
						if($CekMakulDetail->num_rows() >= 1){
							$data['data_mk_detail'] = $CekMakulDetail->result();
						}
					}
				}
			}
		}else{
			$this->db->order_by('NAMADOS','ASC');
			$GetListDos = $this->my_model->tampil("profil_dosen");
			if($GetListDos->num_rows() >= 1){
				$data['GetListDos'] = $GetListDos->result();
			}
		}
		//echo $this->uri->segment(3);
		$this->load->view('publik', $data);
	}

}
