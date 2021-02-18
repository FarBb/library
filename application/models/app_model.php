<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class app_model extends CI_Model {

	public function proseslogin($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		return $this->db->get('user')->row();
	}

	function mp($data){
		$this->db->where('sha1(md5(username))',$data);
		return $this->db->get('user');
	}

	function ubah_simpan($unama,$data){
		$this->db->where('username',$unama);
		return $this->db->update('user',$data);
	}

}
