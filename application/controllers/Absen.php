<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Absen extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('my_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('user_agent');
		ini_set('date.timezone', 'Asia/Jakarta');
		if (!$this->session->userdata('id_user') and $this->session->userdata('id_user') != "0") {
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-info' role='alert'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong></strong> Silahkan login terlebih dahulu.
			</div>");
			redirect('login');
		}
	}

	public function dosenact()
	{
		print_r($_POST);
		$PERTEMUAN = trim($this->security->xss_clean($this->input->post('pertemuan')));
		$KELAS = trim($this->security->xss_clean($this->input->post('kls')));
		$IDMAKUL = trim($this->security->xss_clean($this->input->post('idmakul')));
		$THNSM = trim($this->security->xss_clean($this->input->post('thnsm')));
		$IDPRODI = trim($this->security->xss_clean($this->input->post('idprodi')));
		$SMT = trim($this->security->xss_clean($this->input->post('smt')));
		$TGL = trim($this->security->xss_clean($this->input->post('tgl')));
		$JM = trim($this->security->xss_clean($this->input->post('jm')));
		$JK = trim($this->security->xss_clean($this->input->post('jk')));
		$MATERI = trim($this->security->xss_clean($this->input->post('bahasan')));
		$METODE = json_encode($this->input->post('metode'));
		$TUGAS = trim($this->security->xss_clean($this->input->post('tugas')));
		$JLHHADIR = trim($this->security->xss_clean($this->input->post('hadir')));
		$JLHABSEN = trim($this->security->xss_clean($this->input->post('absen')));
		$CREATED = date("Y-m-d H:i:s", time());
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THNSM' => $THNSM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $KELAS, 'SEMESTER' => $SMT, 'PERTEMUAN' => $PERTEMUAN);
		$CekAbsenDos = $this->my_model->cek_data("absen_dosen", $where);
		if ($CekAbsenDos->num_rows() >= 1) {
			$ShowAbsenMhs = $CekAbsenDos->row();
			$data = array('IDDOSEN' => $this->session->userdata('id_user'), 'THNSM' => $THNSM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $KELAS, 'SEMESTER' => $SMT, 'PERTEMUAN' => $PERTEMUAN, 'TGL' => $TGL, 'JM' => $JM, 'JK' => $JK, 'MATERI' => $MATERI, 'METODE' => $METODE, 'TUGAS' => $TUGAS, 'JLHHADIR' => $JLHHADIR, 'JLHABSEN' => $JLHABSEN);
			if ($this->my_model->update("absen_dosen", $where, $data)) {
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-info' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi berhasil disimpan..!</div>");
			} else {
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi gagal disimpan..!</div>");
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array('IDDOSEN' => $this->session->userdata('id_user'), 'THNSM' => $THNSM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $KELAS, 'SEMESTER' => $SMT, 'PERTEMUAN' => $PERTEMUAN, 'TGL' => $TGL, 'JM' => $JM, 'JK' => $JK, 'MATERI' => $MATERI, 'METODE' => $METODE, 'TUGAS' => $TUGAS, 'JLHHADIR' => $JLHHADIR, 'JLHABSEN' => $JLHABSEN, 'CREATED' => $CREATED);
			if ($this->my_model->tambahdata("absen_dosen", $data)) {
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-info' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi berhasil disimpan..!</div>");
			} else {
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi gagal disimpan..!</div>");
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function simpan()
	{
		$PERTEMUAN = trim($this->security->xss_clean($this->input->post('pertemuan')));
		$KELAS = trim($this->security->xss_clean($this->input->post('kls')));
		$IDMAKUL = trim($this->security->xss_clean($this->input->post('idmakul')));
		$THNSM = trim($this->security->xss_clean($this->input->post('thnsm')));
		$IDPRODI = trim($this->security->xss_clean($this->input->post('idprodi')));
		$SMT = trim($this->security->xss_clean($this->input->post('smt')));
		$CREATED = date("Y-m-d H:i:s", time());
		foreach ($this->input->post('ket') as $mhs => $value) {
			$where = array('IDMAHASISWA' => $mhs, 'THNSM' => $THNSM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $KELAS, 'SEMESTER' => $SMT, 'PERTEMUAN' => $PERTEMUAN);
			$CekAbsenMhs = $this->my_model->cek_data("absen_mhs", $where);
			if ($CekAbsenMhs->num_rows() >= 1) {
				$ShowAbsenMhs = $CekAbsenMhs->row();
				if ($ShowAbsenMhs->ABSENSI != $value) {
					//echo $mhs." : ".$ShowAbsenMhs->ABSENSI ." update to ".$value."<br/>";
					$data = array('ABSENSI' => $value);
					if ($this->my_model->update("absen_mhs", $where, $data)) {
						$this->session->set_flashdata("msg", "<br/><div class='alert alert-info' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi berhasil disimpan..!</div>");
					} else {
						$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi gagal disimpan..!</div>");
					}
				} /* else{
					echo $mhs." : ".$ShowAbsenMhs->ABSENSI ." not update same value ".$value."<br/>";
				} */
			} else {
				$data = array('IDMAHASISWA' => $mhs, 'THNSM' => $THNSM, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'KELAS' => $KELAS, 'SEMESTER' => $SMT, 'PERTEMUAN' => $PERTEMUAN, 'ABSENSI' => $value, 'CREATED' => $CREATED);
				if ($this->my_model->tambahdata("absen_mhs", $data)) {
					$this->session->set_flashdata("msg", "<br/><div class='alert alert-info' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi berhasil disimpan..!</div>");
				} else {
					$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Absensi gagal disimpan..!</div>");
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function print_absen()
	{
		$IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
		$thnAjar = trim($this->security->xss_clean($IdDos = $this->uri->segment(4)));
		$IDPRODI = trim($this->security->xss_clean($IdDos = $this->uri->segment(5)));
		$NAMAKLS = trim($this->security->xss_clean($IdDos = $this->uri->segment(6)));
		$SEMESTER = trim($this->security->xss_clean($IdDos = $this->uri->segment(7)));
		// $where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$this->db->select('THSHM');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$this->db->limit(1);
		// $where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$LasThnAjar = $this->my_model->cek_data("makul_dosen", $where);
		if ($LasThnAjar->num_rows() >= 1) {
			$showLasThnAjar = $LasThnAjar->row();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
			$this->db->order_by('NAMAMK', 'ASC');
			$CekMakul = $this->my_model->cek_data("makul_dosen", $where);
			if ($CekMakul->num_rows() >= 1) {
				$thn_ajr = substr($showLasThnAjar->THSHM, 0, -1);
				$smt = substr($showLasThnAjar->THSHM, -1);
				if ($smt % 2 != 0) {
					$smt_show = "GANJIL";
				} else {
					$smt_show = "GENAP";
				}
				$data['thnAjarInt'] = $showLasThnAjar->THSHM;
				$data['thnAjar'] = $smt_show . " " . $thn_ajr;
				$data['data_mkterkini'] = $CekMakul->result();
			} else {
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
			}
		}

		//disini absen mahasiswa

		$where = array('a.IDMAKUL' => $IDMAKUL, 'a.THNSM' => $thnAjar, 'a.IDPRODI' => $IDPRODI, 'a.KELAS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER);
		$this->db->group_by('a.IDMAHASISWA');
		$this->db->join('mhs_course b', 'b.IDMAHASISWA = a.IDMAHASISWA');
		// $this->db->order_by('a.IDMAHASISWA');
		$CekAbsMhs = $this->my_model->cek_data("absen_mhs a", $where);
		if ($CekAbsMhs->num_rows() >= 1) {
			$data['absen_mhsw'] = $CekAbsMhs->result();

			$this->db->select('a.IDMAHASISWA, a.PERTEMUAN, a.ABSENSI');
			$where = array('a.IDMAKUL' => $IDMAKUL, 'a.THNSM' => $thnAjar, 'a.IDPRODI' => $IDPRODI, 'a.KELAS' => $NAMAKLS, 'a.SEMESTER' => $SEMESTER);
			$this->db->join('mhs_course b', 'b.IDMAHASISWA = a.IDMAHASISWA');
			$ListAbsen = $this->my_model->cek_data("absen_mhs a", $where);
			if ($ListAbsen->num_rows() >= 1) {
				foreach ($ListAbsen->result() as $value) {
					$arr_list_absen[$value->IDMAHASISWA . '_' . $value->PERTEMUAN] = $value->ABSENSI;
					// print_r($arr_list_absen);
				}
				$data['list_absen'] = $arr_list_absen;
			}
		}

		$this->load->view('cetak_absen/absen_cetak', $data);
	}

	public function brt_acara()
	{
		$IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
		$thnAjar = trim($this->security->xss_clean($IdDos = $this->uri->segment(4)));
		$IDPRODI = trim($this->security->xss_clean($IdDos = $this->uri->segment(5)));
		$NAMAKLS = trim($this->security->xss_clean($IdDos = $this->uri->segment(6)));
		$SEMESTER = trim($this->security->xss_clean($IdDos = $this->uri->segment(7)));
		// $where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$this->db->select('THSHM');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$this->db->limit(1);
		// $where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$LasThnAjar = $this->my_model->cek_data("makul_dosen", $where);
		if ($LasThnAjar->num_rows() >= 1) {
			$showLasThnAjar = $LasThnAjar->row();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
			$this->db->order_by('NAMAMK', 'ASC');
			$CekMakul = $this->my_model->cek_data("makul_dosen", $where);
			if ($CekMakul->num_rows() >= 1) {
				$thn_ajr = substr($showLasThnAjar->THSHM, 0, -1);
				$smt = substr($showLasThnAjar->THSHM, -1);
				if ($smt % 2 != 0) {
					$smt_show = "GANJIL";
				} else {
					$smt_show = "GENAP";
				}
				$data['thnAjarInt'] = $showLasThnAjar->THSHM;
				$data['thnAjar'] = $smt_show . " " . $thn_ajr;
				$data['data_mkterkini'] = $CekMakul->result();
			} else {
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Mata Kuliah Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
			}
		}

		$this->db->order_by('PERTEMUAN');
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'IDMAKUL' => $IDMAKUL, 'THNSM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'KELAS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$cekBrtAcr = $this->my_model->cek_data("absen_dosen", $where);
		if ($cekBrtAcr->num_rows() >= 1) {
			$data['brtAcrmk'] =  $cekBrtAcr->result();
		}

		$this->load->view('cetak_absen/berita_acara', $data);
	}

	public function edit_laporan()
	{
		$IDMAKUL = trim($this->security->xss_clean($IdDos = $this->uri->segment(3)));
		$thnAjar = trim($this->security->xss_clean($IdDos = $this->uri->segment(4)));
		$IDPRODI = trim($this->security->xss_clean($IdDos = $this->uri->segment(5)));
		$NAMAKLS = trim($this->security->xss_clean($IdDos = $this->uri->segment(6)));
		$SEMESTER = trim($this->security->xss_clean($IdDos = $this->uri->segment(7)));
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $thnAjar, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $NAMAKLS, 'SEMESTER' => $SEMESTER);
		$cekData = $this->my_model->cek_data("makul_dosen", $where);
		if ($cekData->num_rows() >= 1) {
			$data['data_laporan'] = $cekData->result();

			$data['header'] = "header/header2";
			$data['navbar'] = "navbar/navbar2";
			$data['sidebar'] = "sidebar/sidebar2";
			$data['body'] = "body/v_edit_laporan";
			$data['footer'] = "footer/footer2";
			$this->load->view('template', $data);
		} else {
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Maaf Terjadi Kesalahan Data</div>");
		}
	}

	public function update_lap()
	{
		$IDMAKUL = trim($this->security->xss_clean($this->input->post('idmakul')));
		$IDPRODI = trim($this->security->xss_clean($this->input->post('idprodi')));
		$NAMAMK = trim($this->security->xss_clean($this->input->post('namamk')));
		$THNAJAR = trim($this->security->xss_clean($this->input->post('thnajar')));
		$KELAS = trim($this->security->xss_clean($this->input->post('kelas')));
		$SEMESTER = trim($this->security->xss_clean($this->input->post('smt')));
		$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $THNAJAR, 'IDPRODI' => $IDPRODI, 'IDMAKUL' => $IDMAKUL, 'NAMAKLS' => $KELAS);
		$data = array('smt' => $SEMESTER);
		if ($this->my_model->update("makul_dosen", $where, $data)) {
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-success' role='alert'>Data Berhasil disimpan...!</div>");
		} else {
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'>Data Gagal disimpan...!</div>");
		}
		redirect('absen');
	}

	public function index()
	{
		// $this->load->view('body\view_laporan');
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$this->db->select('THSHM, COUNT(THSHM) as jlh');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$CekMakul = $this->my_model->cek_data("makul_dosen", $where);
		if ($CekMakul->num_rows() >= 1) {
			$data['data_mk'] = $CekMakul->result();
		} else {
			$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
		}

		$this->db->select('THSHM');
		$this->db->group_by('THSHM');
		$this->db->order_by('THSHM', 'DESC');
		$this->db->limit(1);
		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$LasThnAjar = $this->my_model->cek_data("makul_dosen", $where);
		if ($LasThnAjar->num_rows() >= 1) {
			$showLasThnAjar = $LasThnAjar->row();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'THSHM' => $showLasThnAjar->THSHM);
			$this->db->order_by('NAMAMK', 'ASC');
			$CekMakul = $this->my_model->cek_data("makul_dosen", $where);
			if ($CekMakul->num_rows() >= 1) {
				$thn_ajr = substr($showLasThnAjar->THSHM, 0, -1);
				$smt = substr($showLasThnAjar->THSHM, -1);
				if ($smt % 2 != 0) {
					$smt_show = "GANJIL";
				} else {
					$smt_show = "GENAP";
				}
				$data['thnAjarInt'] = $showLasThnAjar->THSHM;
				$data['thnAjar'] = $smt_show . " " . $thn_ajr;
				$data['data_mkterkini'] = $CekMakul->result();
			} else {
				$this->session->set_flashdata("msg", "<br/><div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data MK dosen Tidak ditemukan. Silahkan Klik Tombol Sinkronisasi!</div>");
			}
		}

		$where = array('IDDOSEN' => $this->session->userdata('id_user'));
		$this->db->order_by('NAMA_FILE', 'ASC');
		$CekMateri = $this->my_model->cek_data("bahan_ajar", $where);
		if ($CekMateri->num_rows() >= 1) {
			$data['TotalMateri'] = $CekMateri->num_rows();
			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'pdf');
			$data['jlh_adobe'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_adobe'] = round(($data['jlh_adobe'] / $data['TotalMateri']) * 100, 2);

			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'msword');
			$data['jlh_word'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_word'] = round(($data['jlh_word'] / $data['TotalMateri']) * 100, 2);

			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'mspowerpoint');
			$data['jlh_powerpoint'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_powerpoint'] = round(($data['jlh_powerpoint'] / $data['TotalMateri']) * 100, 2);

			$where = array('IDDOSEN' => $this->session->userdata('id_user'), 'TIPEFILE' => 'postscript');
			$data['jlh_poscript'] = $this->my_model->cek_data("bahan_ajar", $where)->num_rows();
			$data['persen_poscript'] = round(($data['jlh_poscript'] / $data['TotalMateri']) * 100, 2);
		} else {
			$data['TotalMateri'] = $data['persen_adobe'] = $data['persen_poscript'] = $data['persen_word'] = $data['persen_powerpoint'] = 0;
			$data['jlh_adobe'] = $data['jlh_poscript'] = $data['jlh_word'] = $data['jlh_powerpoint'] = 0;
		}
		$data['SifatDokumen'] = array("1" => "Open/Publik", "0" => "Private/Khusus Mahasiswa");

		$data['header'] = "header/header2";
		$data['navbar'] = "navbar/navbar2";
		$data['sidebar'] = "sidebar/sidebar2";
		$data['body'] = "body/view_laporan2";
		$data['footer'] = "footer/footer2";
		$this->load->view('template', $data);
	}
}
