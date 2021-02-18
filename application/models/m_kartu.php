<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_kartu extends CI_Model {

	public function getkartu($limit,$start)
	{
		return $this->db->get('kartu',$limit, $start);
	}

	function simpan($data){
		$this->db->insert('kartu',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(kode_kartu))',$data);
		$this->db->delete('kartu');
	}

	function ubah($id){
		$this->db->where('sha1(md5(kode_kartu))',$id);
		return $this->db->get('kartu');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kode_kartu',$id);
		return $this->db->update('kartu',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from kartu where kode_kartu like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/kartu'>";
			return $qry;
		}
	}

	function caricetak($caricetak){
		$this->db->where('sha1(md5(kode_kartu))',$caricetak);
		return $this->db->get('kartu');
	}
}
