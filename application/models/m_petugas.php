<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_petugas extends CI_Model {

	public function getpetugas($limit,$start)
	{
		return $this->db->get('petugas',$limit, $start);
	}

	function simpan($data){
		$this->db->insert('petugas',$data); 
	}

	function hapus($data){
		$path = FCPATH.'./assets/imgpath/';
		$data2 = $this->db->get_where('petugas', array('sha1(md5(kode_petugas))' => $data));
		foreach ($data2->result() as $obj1) {
			$ft = $obj1->userpic;
		}
		if($ft!="" && file_exists($path.$ft)){
			unlink($path.$ft);
		}
		$this->db->where('sha1(md5(kode_petugas))',$data);
		$this->db->delete('user');
		$this->db->where('sha1(md5(kode_petugas))',$data);
		$this->db->delete('petugas');
	}

	function ubah($data){
		$this->db->where('sha1(md5(kode_petugas))',$data);
		return $this->db->get('petugas');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kode_petugas',$id);
		return $this->db->update('petugas',$data);
	}

	function cari($carijudul){
		$qry = $this->db->query("Select * from petugas where nama_petugas like'$carijudul%' or kode_petugas like'$carijudul%'");
		if($qry->num_rows() > 0){
			return $qry;
		} else {
			echo "<script>alert('Maaf, Data yang Anda Cari Tidak Ditemukan !');</script>";
			echo "<meta http-equiv='refresh' content='0; URL='". base_url() . "home/petugas'>";
			return $qry;
		}
	}

}
