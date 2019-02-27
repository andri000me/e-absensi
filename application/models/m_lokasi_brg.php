<?php
class M_lokasi_brg extends CI_Model{
    public function lihat_lok($number, $offset){
		$this->db->order_by('id_lokasi','DESC');
		return $this->db->get('tb_lokasi', $number, $offset)->result();
	}
	public function cek_data($tabel, $where){
		return $this->db->get_where($tabel, $where);
	}
	function jumlah_lok(){
		return $this->db->get('tb_lokasi')->num_rows();
	}
	public function tambahdata($table, $data){
		return $this->db->insert($table, $data);
	}
	
	public function hapusdata($table, $where){
		$this->db->where($where);
		return $this->db->delete($table, $where);
	}
	
	public function updatedata($table, $where, $data){
		$this->db->where($where);
		return $this->db->update($table, $data);
	}
}?>