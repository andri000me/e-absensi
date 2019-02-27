<?php
class My_model extends CI_Model{
    public function cek_data($tabel, $where){
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
	public function get_last(){
		$this->db->order_by('id_taruna','DESC');
		$this->db->limit(1);
		return $this->db->get("tb_taruna")->row();
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
	public function tampil_page($number, $offset, $where=null){
		if($where !=null){
			$this->db->where($where);
		}
		return $this->db->get('makul_dosen', $number, $offset)->result();
	}
	public function cek_detail($where){
		$this->db->select('a.id_taruna, a.no_daftar, a.nama, a.tempat_lahir, a.jk, a. tgl_lahir, b.nama_dikum, a.jurusan, a.tahun_lulus, a.nilai_uan, a.tb, a.bb, k.nama_agama, l.nama_job, a.tempat_domisili, c.nama as desa_domisili, d.nama as kec_domisili, e.nama as kab_domisili, f.nama as prov_domisili, a.nohp, a.asal_sekolah, a.keahlian, a.tingkat, g.nama as nama_desa, h.nama as nama_kec, i.nama as nama_kab, j.nama as nama_prov, a.foto, a.nama_ayah, m.nama_job as pekerjaan_ayah, t.nama_suku as suku_ayah, a.pangkat_ayah, a.satuan_ayah, a.nama_ibu, n.nama_job as pekerjaan_ibu, u.nama_suku as suku_ibu, o.nama as desa_ortu, p.nama as kec_ortu, q.nama as kab_ortu, r.nama as prov_ortu, a.created, s.nama_periode, a.bidang_keahlian');
		
		$this->db->join('tb_suku u', 'u.id_suku = a.suku_ibu', 'left');
		$this->db->join('tb_suku t', 't.id_suku = a.suku_ayah', 'left');
		$this->db->join('tb_periode s', 's.id_periode = a.id_periode', 'left');
		$this->db->join('provinsi r', 'r.id = a.prov_ortu', 'left');
		$this->db->join('kabupaten q', 'q.id = a.kab_ortu', 'left');
		$this->db->join('kecamatan p', 'p.id = a.kec_ortu', 'left');
		$this->db->join('desa o', 'o.id = a.desa_ortu', 'left');		
		$this->db->join('tb_pekerjaan n', 'n.id_job = a.pekerjaan_ibu', 'left');
		$this->db->join('tb_pekerjaan m', 'm.id_job = a.pekerjaan_ayah', 'left');
		$this->db->join('tb_pekerjaan l', 'l.id_job = a.pekerjaan', 'left');
		$this->db->join('tb_agama k', 'k.id_agama = a.agama', 'left');
		$this->db->join('provinsi j', 'j.id = a.prov', 'left');
		$this->db->join('kabupaten i', 'i.id = a.kab', 'left');
		$this->db->join('kecamatan h', 'h.id = a.kec', 'left');
		$this->db->join('desa g', 'g.id = a.desa', 'left');
		$this->db->join('provinsi f', 'f.id = a.prov_domisili', 'left');
		$this->db->join('kabupaten e', 'e.id = a.kab_domisili', 'left');
		$this->db->join('kecamatan d', 'd.id = a.kec_domisili', 'left');
		$this->db->join('desa c', 'c.id = a.desa_domisili', 'left');
		$this->db->join('tb_dikum b', 'b.id_dikum = a.dikum', 'left');
		return $this->db->get_where('tb_taruna a', $where);
	}
	public function cek_cari($dikum,$agama,$jobayah,$propinsi,$status_lulus,$jk,$bidang,$PriodeAktif){
		//$this->db->select('a.*, b.nama_dikum, c.nama_agama, d.nama_job as pekerjaan_ayah, e.nama as nama_prov');
		$this->db->select('a.id_taruna, a.no_daftar, a.nama, a.tempat_lahir, a.jk, a. tgl_lahir, b.nama_dikum, a.jurusan, a.tahun_lulus, a.nilai_uan, a.tb, a.bb, k.nama_agama, l.nama_job, a.tempat_domisili, c.nama as desa_domisili, d.nama as kec_domisili, e.nama as kab_domisili, f.nama as prov_domisili, a.nohp, a.asal_sekolah, a.keahlian, a.tingkat, g.nama as nama_desa, h.nama as nama_kec, i.nama as nama_kab, j.nama as nama_prov, a.foto, a.nama_ayah, m.nama_job as pekerjaan_ayah, t.nama_suku as suku_ayah, a.pangkat_ayah, a.satuan_ayah, a.nama_ibu, n.nama_job as pekerjaan_ibu, u.nama_suku as suku_ibu,, o.nama as desa_ortu, p.nama as kec_ortu, q.nama as kab_ortu, r.nama as prov_ortu, a.created, s.nama_periode, a.bidang_keahlian, a.status_kelulusan');
		$where ="a.id_periode='$PriodeAktif'";
		if($dikum !='' || $agama !='' || $jobayah !='' || $propinsi !='' || $status_lulus !='' || $jk !='' || $bidang !=''){
			if($dikum !=''){
				/* if(empty($where)){
					$where .="a.dikum='$dikum'";
				}else{ */
					$where .="AND a.dikum='$dikum'";
				//}
			}
			if($agama !=''){
				/* if(empty($where)){
					$where .="a.agama = '$agama'";
				}else{ */
					$where .="AND a.agama = '$agama'";
				//}
			}
			if($jobayah !=''){
				/* if(empty($where)){
					$where .="a.pekerjaan_ayah = '$jobayah'";
				}else{ */
					$where .="AND a.pekerjaan_ayah = '$jobayah'";
				//}
			}
			if($propinsi !=''){
				/* if(empty($where)){
					$where .="a.prov = '$propinsi'";
				}else{ */
					$where .="AND a.prov = '$propinsi'";
				//}
			}
			if($status_lulus !=''){
				/* if(empty($where)){
					$where .="a.status_kelulusan = '$status_lulus'";
				}else{ */
					$where .="AND a.status_kelulusan = '$status_lulus'";
				//}
			}
			if($jk !=''){
				/* if(empty($where)){
					$where .="a.jk = '$jk'";
				}else{ */
					$where .="AND a.jk = '$jk'";
				//}
			}
			if($bidang !=''){
				/* if(empty($where)){
					$where .="a.bidang_keahlian = '$bidang'";
				}else{ */
					$where .="AND a.bidang_keahlian = '$bidang'";
				//}
			}
		}
		$this->db->where('('.$where.')');
		/* $this->db->join('provinsi e', 'e.id = a.prov', 'join');
		$this->db->join('tb_pekerjaan d', 'd.id_job = a.pekerjaan_ayah', 'join');
		$this->db->join('tb_agama c', 'c.id_agama = a.agama', 'join');
		$this->db->join('tb_dikum b', 'b.id_dikum = a.dikum', 'join'); */
		$this->db->join('tb_suku u', 'u.id_suku = a.suku_ibu', 'left');
		$this->db->join('tb_suku t', 't.id_suku = a.suku_ayah', 'left');
		$this->db->join('tb_periode s', 's.id_periode = a.id_periode', 'left');
		$this->db->join('provinsi r', 'r.id = a.prov_ortu', 'left');
		$this->db->join('kabupaten q', 'q.id = a.kab_ortu', 'left');
		$this->db->join('kecamatan p', 'p.id = a.kec_ortu', 'left');
		$this->db->join('desa o', 'o.id = a.desa_ortu', 'left');		
		$this->db->join('tb_pekerjaan n', 'n.id_job = a.pekerjaan_ibu', 'left');
		$this->db->join('tb_pekerjaan m', 'm.id_job = a.pekerjaan_ayah', 'left');
		$this->db->join('tb_pekerjaan l', 'l.id_job = a.pekerjaan', 'left');
		$this->db->join('tb_agama k', 'k.id_agama = a.agama', 'left');
		$this->db->join('provinsi j', 'j.id = a.prov', 'left');
		$this->db->join('kabupaten i', 'i.id = a.kab', 'left');
		$this->db->join('kecamatan h', 'h.id = a.kec', 'left');
		$this->db->join('desa g', 'g.id = a.desa', 'left');
		$this->db->join('provinsi f', 'f.id = a.prov_domisili', 'left');
		$this->db->join('kabupaten e', 'e.id = a.kab_domisili', 'left');
		$this->db->join('kecamatan d', 'd.id = a.kec_domisili', 'left');
		$this->db->join('desa c', 'c.id = a.desa_domisili', 'left');
		$this->db->join('tb_dikum b', 'b.id_dikum = a.dikum', 'left');
		return $this->db->get('tb_taruna a');
	}
	public function rekap_job($where){
		$this->db->select('b.nama_job, COUNT(*) as jlh');
		$this->db->order_by('b.nama_job','ASC');
		$this->db->group_by('a.pekerjaan_ayah');
		$this->db->join('tb_pekerjaan b', 'b.id_job = a.pekerjaan_ayah', 'join');
		return $this->db->get_where("tb_taruna a", $where);
	}
	public function rekap_suku($where){
		$this->db->select('b.nama_suku, COUNT(*) as jlh');
		$this->db->order_by('b.nama_suku','ASC');
		$this->db->group_by('a.suku_ayah');
		$this->db->join('tb_suku b', 'b.id_suku = a.suku_ayah', 'join');
		return $this->db->get_where("tb_taruna a", $where);
	}
	public function rekap_dikum($where){
		$this->db->select('b.nama_dikum, COUNT(*) as jlh');
		$this->db->order_by('b.nama_dikum','ASC');
		$this->db->group_by('a.dikum');
		$this->db->join('tb_dikum b', 'b.id_dikum = a.dikum', 'join');
		return $this->db->get_where("tb_taruna a", $where);
	}
	public function rekap_agama($where){
		$this->db->select('b.nama_agama, COUNT(*) as jlh');
		$this->db->order_by('b.nama_agama','ASC');
		$this->db->group_by('a.agama');
		$this->db->join('tb_agama b', 'b.id_agama = a.agama', 'join');
		return $this->db->get_where("tb_taruna a", $where);
	}
	public function rekap_thnlulus($where){
		$this->db->select('tahun_lulus, COUNT(*) as jlh');
		$this->db->order_by('tahun_lulus','ASC');
		$this->db->group_by('tahun_lulus');
		return $this->db->get_where("tb_taruna", $where);
	}
	public function lihat_dikum($number, $offset){
		$this->db->order_by('nama_dikum','ASC');
		return $this->db->get('tb_dikum', $number, $offset)->result();
	}
	public function lihat_agama($number, $offset){
		$this->db->order_by('nama_agama','ASC');
		return $this->db->get('tb_agama', $number, $offset)->result();
	}
	public function lihat_pekerjaan($number, $offset){
		$this->db->order_by('nama_job','ASC');
		return $this->db->get('tb_pekerjaan', $number, $offset)->result();
	}
	public function lihat_suku($number, $offset){
		$this->db->order_by('nama_suku','ASC');
		return $this->db->get('tb_suku', $number, $offset)->result();
	}
	public function lihat_periode($number, $offset){
		$this->db->order_by('nama_periode','ASC');
		return $this->db->get('tb_periode', $number, $offset)->result();
	}
}?>