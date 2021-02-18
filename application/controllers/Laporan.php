<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_laporan');
	}

	public function index(){
		$menu['laporan_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-copy"></i> Laporan';
		$plugin['date_plugin'] = 1;

		$this->load->view('dashboard-header',$menu);
		$this->load->view('laporan/t_laporan');
		$this->load->view('dashboard-footer',$plugin);
	}

	public function generate(){
		$tb = $this->input->post('laporan_data');
		$tgl_start = $this->input->post('tanggal_start');
		$tgl_end = $this->input->post('tanggal_end');

		if($tgl_start!='' && ($tb=='peminjaman')){
			$data['dt'] = $this->M_laporan->getlaporan_tgl($tb,$tgl_start,$tgl_end);
		} else {
			$data['dt'] = $this->M_laporan->getlaporan($tb);	
		}
		
		$this->load->view('laporan/laporan_'.$tb,$data);
	}

}
