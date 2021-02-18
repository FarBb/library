<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_kategori extends CI_Model {

	public function getkategori($limit, $start)
	{
		return $this->db->get('kategori',$limit, $start);
	}

	function simpan($data){
		$this->db->insert('kategori',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(kode_kategori))',$data);
		$this->db->delete('kategori');
	}

	function ubah($data){
		$this->db->where('sha1(md5(kode_kategori))',$data);
		return $this->db->get('kategori');
	}

	function ubah_simpan($kd,$data){
		$this->db->where('kode_kategori',$kd);
		return $this->db->update('kategori',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from kategori where nama_kategori like'$carijudul%' or kode_kategori like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/kategori'>";
			return $qry;
		}
	}

}
