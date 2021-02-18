<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_peminjamanonline extends CI_Model {

	public function getpeminjamanonline()
	{
		return $this->db->get('peminjaman_online');
	}

	function simpan($data){
		$this->db->insert('peminjaman_online',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(id_peminjaman_online))',$data);
		$this->db->delete('peminjaman_online');
	}

	function ubah_status($id,$data){
		$this->db->where('sha1(md5(id_peminjaman_online))',$id);
		return $this->db->update('peminjaman_online',$data);
	}

	function ubah_simpan($id,$data){
		$this->db->where('id_peminjaman_online',$id);
		return $this->db->update('peminjaman_online',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from peminjaman_online where kode_buku like'$carijudul%' or kode_kartu like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/peminjaman_online'>";
			return $qry;
		}
	}

}
