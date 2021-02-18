<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_buku extends CI_Model {

	public function getbuku($limit,$start)
	{
		return $this->db->get('buku',$limit, $start);
	}

	public function getallbuku(){
		return $this->db->get('buku');
	}

	function simpan($data){
		$this->db->insert('buku',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(kode_buku))',$data);
		$this->db->delete('buku');
	}

	function ubah($data){
		$this->db->where('sha1(md5(kode_buku))',$data);
		return $this->db->get('buku');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kode_buku',$id);
		return $this->db->update('buku',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from buku where judul_buku like'$carijudul%' or kode_buku like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/buku'>";
			return $qry;
		}
	}

}
