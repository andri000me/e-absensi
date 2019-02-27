<?php
class M_user extends CI_Model{
    public function lihat_user($number, $offset){
		$this->db->order_by('id_user','DESC');
		return $this->db->get('tb_user', $number, $offset)->result();
	}
	public function cek_data($tabel, $where){
		return $this->db->get_where($tabel, $where);
	}
	function jumlah_user(){
		return $this->db->get('tb_user')->num_rows();
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