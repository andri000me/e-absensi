<?php
class M_entri_brg extends CI_Model{
    public function lihat_brg($number, $offset){
		$this->db->order_by('id_brg','DESC');
		return $this->db->get('tb_barang', $number, $offset)->result();
	}
	
	public function cek_data($tabel, $where){
		return $this->db->get_where($tabel, $where);
	}
	
	public function get_last(){
		$this->db->order_by('id_brg','DESC');
		$this->db->limit(1);
		return $this->db->get("tb_barang")->row();
	}
	
	public function jenis_brg(){
		$this->db->order_by('nama', 'ASC');
		return $this->db->get('tb_kat_brg')->result();
	}
	
	public function lokasi_brg(){
		$this->db->order_by('nama', 'ASC');
		return $this->db->get('tb_lokasi')->result();
	}
	
	public function tambahdata($table, $data){
		return $this->db->insert($table, $data);
	}
	
	public function hapusbrg($table, $where){
		$this->db->where($where);
		return $this->db->delete($table, $where);
	}
	
	public function update_brg($table, $where, $data){
		$this->db->where($where);
		return $this->db->update($table, $data);
	}
}?>