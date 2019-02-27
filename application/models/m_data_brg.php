<?php
class M_data_brg extends CI_Model{
    public function lihat_brg($number, $offset){
		$this->db->select('a.id_brg, a.kode_brg, b.nama as nama_kat, a.nama, a.merek, a.thn_anggaran, a.cara_perolehan, a.kondisi, c.nama as nama_lokasi, a.tgl_terima, a.foto_brg, a.created');
		//$this->db->from('tb_barang a');
		$this->db->join('tb_kat_brg b', 'b.id_kat_brg = a.id_kat_brg', 'left');
		$this->db->join('tb_lokasi c', 'c.id_lokasi = a.id_lokasi', 'left');
		$this->db->order_by('a.id_brg','DESC');
		return $this->db->get('tb_barang a', $number, $offset)->result();
	}
	public function cek_detail($where){
		$this->db->select('a.id_brg, a.kode_brg, b.nama as nama_kat, a.nama, a.merek, a.thn_anggaran, a.cara_perolehan, a.kondisi, c.nama as nama_lokasi, a.tgl_terima, a.foto_brg, a.created');
		$this->db->join('tb_kat_brg b', 'b.id_kat_brg = a.id_kat_brg', 'left');
		$this->db->join('tb_lokasi c', 'c.id_lokasi = a.id_lokasi', 'left');
		return $this->db->get_where('tb_barang a', $where);
	}
	public function cek_cari($jns,$thnagr,$kondisibrg,$tglbrg,$lokasibrg){
		$this->db->select('a.id_brg, a.kode_brg, b.nama as nama_kat, a.nama, a.merek, a.thn_anggaran, a.cara_perolehan, a.kondisi, c.nama as nama_lokasi, a.tgl_terima, a.foto_brg, a.created');
		$this->db->join('tb_kat_brg b', 'b.id_kat_brg = a.id_kat_brg', 'left');
		$this->db->join('tb_lokasi c', 'c.id_lokasi = a.id_lokasi', 'left');
		if($jns !='' || $thnagr !='' || $kondisibrg !='' || $tglbrg !='' || $lokasibrg !=''){
			$where ='';
			if($jns !=''){
				if(empty($where)){
					$where .="a.id_kat_brg='$jns'";
				}
			}
			if($thnagr !=''){
				if(empty($where)){
					$where .="a.thn_anggaran = '$thnagr'";
				}else{
					$where .="AND a.thn_anggaran = '$thnagr'";
				}
			}
			if($kondisibrg !=''){
				if(empty($where)){
					$where .="a.kondisi = '$kondisibrg'";
				}else{
					$where .="AND a.kondisi = '$kondisibrg'";
				}
			}
			if($tglbrg !=''){
				if(empty($where)){
					$where .="a.tgl_terima = '$tglbrg'";
				}else{
					$where .="AND a.tgl_terima = '$tglbrg'";
				}
			}
			if($lokasibrg !=''){
				if(empty($where)){
					$where .="a.id_lokasi = '$lokasibrg'";
				}else{
					$where .="AND a.id_lokasi = '$lokasibrg'";
				}
			}
			$this->db->where('('.$where.')');
		}
		return $this->db->get('tb_barang a');
	}
	public function cek_data($tabel, $where){
		return $this->db->get_where($tabel, $where);
	}
	
	public function riwayat_lokasi($where){
		$this->db->select('a.id_brg, a.created as tgl_update, b.nama');
		$this->db->join('tb_lokasi b', 'b.id_lokasi = a.id_lokasi', 'left');
		return $this->db->get_where("tb_rw_lokasi_brg a", $where);
	}
	
	public function jumlah_brg(){
		return $this->db->get('tb_barang')->num_rows();
	}
}?>