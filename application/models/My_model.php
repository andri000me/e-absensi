<?php
class My_model extends CI_Model{

  public function get_mhs(){
    $this->db->order_by('IDMAHASISWA', 'DESC');
    $query = $this->db->get('absen_mhs');
   return $query->result();
  }
  public function cek_data($tabel, $where){
		//$this->db->escape_like_str($search);
		return $this->db->get_where($tabel, $where);
	}
	public function tampil($tabel){
		return $this->db->get($tabel);
	}
	public function total($tabel, $where=null){
		if($where !=null){
			$this->db->where($where);
		}
		return $this->db->get($tabel)->num_rows();
	}
	public function tambahdata($table, $data){
		return $this->db->insert($table, $data);
	}
	public function hapus($table, $where){
		$this->db->where($where);
		return $this->db->delete($table, $where);
	}

	public function update($table, $where, $data){
		if($where !=null){
			$this->db->where($where);
		}
		return $this->db->update($table, $data);
	}
	public function tampil_page($number, $offset){
		return $this->db->get('atur_bahan_ajar a', $number, $offset);
	}

	public function fetchUrl($url){
		$allowUrlFopen = preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen'));
		if($allowUrlFopen){
			return file_get_contents($url);
		}elseif(function_exists('curl_init')) {
			$c = curl_init($url);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			$contents = curl_exec($c);
			curl_close($c);
			if(is_string($contents)) {
				return $contents;
			}
		}
		return false;
	}

	function cek_mhs($IDMAKUL = "", $thnAjar = "", $IDPRODI = "", $NAMAKLS = "", $SEMESTER = "", $PERTEMUAN = ""){
		//$this->db->select('a.*, (SELECT mhs_course.NAMAMHS FROM mhs_course WHERE mhs_course.IDMAHASISWA = a.IDMAHASISWA limit 1) as NAMAMHS');
		$this->db->from('mhs_course a');
		$this->db->where('a.IDMAKUL', $IDMAKUL);
		$this->db->where('a.THNSM', $thnAjar);
		//$this->db->where('a.IDPRODI', $IDPRODI);
		$this->db->where('a.KELAS', $NAMAKLS);
		$this->db->where('a.SEMESTER', $SEMESTER);
		//$this->db->where('a.PERTEMUAN', $PERTEMUAN);
			
		$result = $this->db->get();
		if($result->num_rows() > 0){
			return $result->result();
		} else {
			return NULL;
		}
	}
	
	function cek_mhs_absen($IDMAKUL = "", $thnAjar = "", $IDPRODI = "", $NAMAKLS = "", $SEMESTER = "", $PERTEMUAN = ""){
		$this->db->from('absen_mhs a');
		$this->db->where('a.IDMAKUL', $IDMAKUL);
		$this->db->where('a.THNSM', $thnAjar);
		$this->db->where('a.IDPRODI', $IDPRODI);
		$this->db->where('a.KELAS', $NAMAKLS);
		$this->db->where('a.SEMESTER', $SEMESTER);
		$this->db->where('a.PERTEMUAN', $PERTEMUAN);
			
		$result = $this->db->get();
		if($result->num_rows() > 0){
			return $result->result();
		} else {
			return NULL;
		}

	}
}?>
