<?php
class M_kondisi_brg extends CI_Model{
    public function total_kategori($tabel, $where){
		return $this->db->get_where($tabel, $where);
	}
	public function total_kondisi($tabel){
		return $this->db->get($tabel);

	}
}?>