<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

	public function getlaporan($tabel)
	{
		return $this->db->get($tabel);
	}

	public function getlaporan_tgl($tabel,$tgl_start,$tgl_end){
		if($tabel == 'peminjaman'){
			return $this->db->query('select * from '.$tabel.' where tgl_pinjam between \''.$tgl_start.'\' and \''.$tgl_end.'\'');
		} else {
			return $this->db->query('select * from '.$tabel.' where tgl_'.$tabel.' between \''.$tgl_start.'\' and \''.$tgl_end.'\'');
		}
	}
}
