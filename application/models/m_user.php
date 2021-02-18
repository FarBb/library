<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_user extends CI_Model {

	public function getuser($limit, $start)
	{
		return $this->db->get('user',$limit, $start);
	}

	function simpan($data){
		$this->db->insert('user',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(username))',$data);
		$this->db->delete('user');
	}

	function ubah($data){
		$this->db->where('sha1(md5(username))',$data);
		return $this->db->get('user');
	}

	function ubah_simpan($unama,$data){
		$this->db->where('username',$unama);
		return $this->db->update('user',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from user where username like'$carijudul%' or kode_petugas like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/user'>";
			return $qry;
		}
	}

}
