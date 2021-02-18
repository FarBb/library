<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_peminjam extends CI_Model {

	public function getpeminjam($limit,$start)
	{
		return $this->db->get('peminjam',$limit, $start);
	}

	function simpan($data){
		$this->db->insert('peminjam',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(kode_peminjam))',$data);
		$this->db->delete('peminjam');
		$this->db->where('sha1(md5(kode_peminjam))',$data);
		$this->db->delete('kartu');
	}

	function ubah($data){
		$this->db->where('sha1(md5(kode_peminjam))',$data);
		return $this->db->get('peminjam');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kode_peminjam',$id);
		return $this->db->update('peminjam',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from peminjam where nama like'$carijudul%' or kode_peminjam like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/peminjam'>";
			return $qry;
		}
	}

}
