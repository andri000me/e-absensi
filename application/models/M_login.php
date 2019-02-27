<?php
class M_login extends CI_Model{
    public function cek_login($tabel, $where){
        return $this->db->get_where($tabel, $where);

	}
	public function post_to_url($url, $data){
		$fields = '';
		foreach ($data as $key => $value) {
			$fields .= $key . '=' . $value . '&';
		}
		rtrim($fields, '&');
		$post = curl_init();
		curl_setopt($post, CURLOPT_URL, $url);
		curl_setopt($post, CURLOPT_POST, count($data));
		curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($post);
		curl_close($post);
		return $result;
	}
}?>