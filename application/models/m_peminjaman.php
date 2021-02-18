<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_peminjaman extends CI_Model {

	public function getpeminjaman($limit,$start)
	{
		return $this->db->get('peminjaman',$limit, $start);
	}

	function simpan($data){
		$this->db->insert('peminjaman',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(kode_peminjaman))',$data);
		$this->db->delete('peminjaman');
	}

	function ubah($data,$hs){
		$this->db->where('sha1(md5(kode_peminjaman))',$data);
		return $this->db->update('peminjaman',$hs);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from peminjaman where kode_peminjaman like'$carijudul%' or kode_peminjaman like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/peminjaman'>";
			return $qry;
		}
	}

}
