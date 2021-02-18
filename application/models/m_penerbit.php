<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_penerbit extends CI_Model {

	public function getpenerbit($limit,$start)
	{
		return $this->db->get('penerbit',$limit, $start);
	}

	function simpan($data){
		$this->db->insert('penerbit',$data);
	}

	function hapus($data){
		$this->db->where('sha1(md5(kode_penerbit))',$data);
		$this->db->delete('penerbit');
	}

	function ubah($data){
		$this->db->where('sha1(md5(kode_penerbit))',$data);
		return $this->db->get('penerbit');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kode_penerbit',$id);
		return $this->db->update('penerbit',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from penerbit where nama_penerbit like'$carijudul%' or kode_penerbit like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/penerbit'>";
			return $qry;
		}
	}

}
