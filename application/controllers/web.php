<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class web extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_buku');
		$this->load->model('m_kategori');
		$this->load->model('m_peminjamanonline');
		$this->load->model('m_peminjam');
		$this->load->model('m_kartu');
	}

	public function index()
	{
		$data['sql1'] = $this->m_buku->getbuku(3,0);
		$this->load->view('web/index.php',$data);
	}

	public function login()
	{
		$this->load->view('web/login');
	}

	public function daftar_buku()
	{
		$data['sql1'] = $this->m_buku->getbuku(3,0);
		$data['sql2'] = $this->m_buku->getallbuku();          
		$this->load->view('web/daftar_buku',$data);
	}

	public function pinjam_online($msg = null)
	{	
		$data['kon'] = mysqli_connect('localhost','root','','library');
		$data['sql1'] = $this->m_peminjamanonline->getpeminjamanonline();
		$data['sql2'] = $this->db->query('select * from buku where jumlah_buku > 0');
		$data['msg'] = $msg;
		$this->load->view('web/pinjam_online',$data);
	}
	
	public function pinjam_online_validation()
	{
		$kdkartu = $this->input->post('kodekartu');
		$idbuku = $this->input->post('idbuku');
		$tgl = date('Y-m-d');
		if(!$this->validate_anggota($kdkartu)) {
			$msg = 'Kode Kartu Tidak Ditemukan!!';
			$this->pinjam_online($msg);
		} else if(!$this->validate_peminjaman_online($kdkartu,$idbuku)) {
			$msg = 'Peminjaman anda dengan Kode Kartu '.$kdkartu.' dan Kode Buku '.$idbuku.' sudah terdaftar dan belum divalidasi, silahkan validasi terlebih dahulu !!';
			$this->pinjam_online($msg);
		} else{
			$data = array(
				'id_peminjaman_online' => '',
				'kode_kartu' => $kdkartu,
				'kode_buku' => $idbuku,
				'tgl_entry' => $tgl,
				'status' => 'NOT VALIDATED' );
			$this->m_peminjamanonline->simpan($data);
			$msg = 'Peminjaman Online Berhasil!! Silahkan Validasi ke Petugas Perpustakaan.';
			$this->pinjam_online($msg);
		}
	}

	public function pjonline_hapus($data)
	{
		$this->m_peminjamanonline->hapus($data);
		redirect('web/pinjam_online');
	}

	function validate_anggota($kdkartu)
	{
		$numrow = $this->db->query('select * from kartu where kode_kartu = "'.$kdkartu.'" && status = "Aktif"');
		$ret = $numrow->num_rows();
		if($ret == 1) return true;
		else return false;
	}

	function validate_peminjaman_online($kdkartu,$kdbuku)
	{
		$numrow = $this->db->query('select * from peminjaman_online where kode_kartu = "'.$kdkartu.'" && kode_buku = "'.$kdbuku.'" && status = "NOT VALIDATED"');
		$ret = $numrow->num_rows();
		if($ret>0) return false;
		else return true;
	}

	public function validate_login()
	{
		if(isset($_POST['login'])){
			$kdkartu = $this->input->post('kodekartu',true);
			$password = $this->input->post('password',true);
			$data = $this->db->get_where('kartu',array('kode_kartu' => $kdkartu, 'password' => $password, 'status' => 'Aktif'))->row();
			if (count($data) > 0){
				$this->session->set_userdata('status','loggedin');
				$this->session->set_userdata('nama',$data->nama);
				$this->session->set_userdata('kdkartu',$data->kode_kartu);
				redirect (base_url().'web');
			} else {
				$this->session->set_userdata('msg','Username Atau Password Salah, Pastikan Kartu Anggota Anda Aktif !!');
				redirect(base_url().'web/login');
			}
		}
	}

	public function log_out()
	{
		$this->session->unset_userdata('kdkartu');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('status');
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

