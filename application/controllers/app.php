<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class app extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_buku');
		$this->load->model('m_petugas');
		$this->load->model('m_user');
		$this->load->model('m_kategori');
		$this->load->model('app_model');
		$this->load->model('m_penerbit');
		$this->load->model('m_peminjam');
		$this->load->model('m_peminjaman');
		$this->load->model('m_peminjamanonline');
		$this->load->model('m_kartu');
	}

	public function index(){
		redirect(base_url().'web');
	}

	public function login_admin()
	{
		$this->load->view('login');
		
	}

	//BEGIN LOGIN 
	public function val_login()
	{
		if(isset($_POST['login'])){
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			$cek = $this->app_model->proseslogin($username,$password);
			if (count($cek) > 0){
				$data = $this->db->get_where('user',array('username' => $username, 'password' => $password))->row();
				$kdp = $data->kode_petugas;
				$data2 = $this->db->get_where('petugas',array('kode_petugas' => $kdp))->row();
				$this->session->set_userdata('status','loggedin');
				$this->session->set_userdata('username',$data->username);
				$this->session->set_userdata('level',$data->level);
				$this->session->set_userdata('userpic',$data2->userpic);
				redirect ('app/home');
			} else {
				$this->session->set_userdata('msg','Username Atau Password Salah');
				redirect(base_url().'app/login_admin');
			}
		}
	}

	public function log_out()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('status');
		$this->session->sess_destroy();
		redirect(base_url());
	}
	//END OF LOGIN

	public function home()
	{
		$this->load->view('home');
		
	}

	//BEGIN HELP
	public function help()
	{
		$this->load->view('help/header_help');
		$this->load->view('help/content');
		$this->load->view('help/footer_help');

	}
	//END OF HELP

	//BEGIN MANAGEPROFILE
	public function manageprofile($data)
	{
		$upd['sql'] = $this->app_model->mp($data);
		$this->load->view('manageprofile/header_mp');
		$this->load->view('manageprofile/mp',$upd);
		$this->load->view('manageprofile/footer_mp');
	}

	public function mp_simpan($data)
	{
        //data
        $id=$this->input->post('idpetugas');
        $unama=$this->input->post('username');
        $pass=$this->input->post('password');
        $level=$this->input->post('level');

            $data = array(
               	'kode_petugas' => $id,
				'username' => $unama,
				'password' => $pass,
				'level' => $level
                );
            $this->app_model->ubah_simpan($unama,$data);
            redirect('app/log_out');
        
	}
	//END OF MANAGEPROFILE

	//BEGIN BUKU
	public function buku()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/buku/';
        $config['total_rows'] = $this->db->count_all('buku');
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_buku->getbuku($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('buku/header_buku');
		$this->load->view('buku/t_buku',$data);
		$this->load->view('buku/footer_buku');
		
	}

	public function b_tambah()
	{
		$data['op'] = 'tambah';
		$this->load->view('buku/header_buku');
		$this->load->view('buku/tambah_buku',$data);
		$this->load->view('buku/footer_buku');

	}

	public function b_simpan()
	{
		$op = $this->input->post('op');
		$id = $this->input->post('idbuku');
		$ktg = $this->input->post('kategori');
		$penerbit = $this->input->post('penerbit');
		$judul = $this->input->post('judul');
		$jml = $this->input->post('jumlah');
		$des = $this->input->post('deskripsi');
		$pengarang = $this->input->post('pengarang');
		$thn = $this->input->post('thterbit');

		$data = array(
			'kode_buku' => $id,
			'kode_kategori' => $ktg,
			'kode_penerbit' => $penerbit,
			'judul_buku' => $judul,
			'jumlah_buku' => $jml,
			'diskripsi' => $des,
			'pengarang' => $pengarang,
			'tahun_terbit' => $thn );

		if($op=='tambah'){
			$this->m_buku->simpan($data);
		} else {
			$this->m_buku->ubah_simpan($id,$data);
		}

		redirect('app/buku');

	}

	public function b_hapus($data)
	{
		$this->m_buku->hapus($data);
		redirect('app/buku');

	}

	public function b_ubah($data)
	{
		$upd['op'] = 'edit';
		$upd['sql'] = $this->m_buku->ubah($data);
		$this->load->view('buku/header_buku');
		$this->load->view('buku/tambah_buku',$upd);
		$this->load->view('buku/footer_buku');
	}

	public function b_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
			$data['sql1']=$this->m_buku->cari($carijudul);
			$data['c'] = 'cari';
			$data['carijudul'] = $carijudul;
			$this->load->view('buku/header_buku');
			$this->load->view('buku/t_buku',$data);
			$this->load->view('buku/footer_buku');
		} else {
			redirect('app/buku');
		}
	}
	//END OF BUKU
	
	//PETUGAS
	public function petugas()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/petugas/';
        $config['total_rows'] = $this->db->count_all('petugas');
        $config['per_page'] = "6";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_petugas->getpetugas($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('petugas/header_petugas');
		$this->load->view('petugas/t_petugas',$data);
		$this->load->view('petugas/footer_petugas');
		
	}

	public function p_tambah()
	{
		$data['op'] = 'tambah';
		$this->load->view('petugas/header_petugas');
		$this->load->view('petugas/tambah_petugas',$data);
		$this->load->view('petugas/footer_petugas');

	}

	public function p_simpan()
	{
		$nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './assets/imgpath/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '5000'; //maksimum besar file 5M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

		$op = $this->input->post('op');
		$id = $this->input->post('idpetugas');
		$nama = $this->input->post('nama');
		$gender = $this->input->post('gender');
		$almt = $this->input->post('alamat');
		$telp = $this->input->post('telp');

		$this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name']))
        {
             
            $this->upload->do_upload('filefoto');
            $gbr = $this->upload->data();
            $data = array(
				'kode_petugas' => $id,
				'nama_petugas' => $nama,
				'gender' => $gender,
				'alamat' => $almt,
				'no_telepon' => $telp, 		
               	'userpic' =>$gbr['file_name'],
              	'type' =>$gbr['file_type']
                );

            if($op=='tambah'){
				$this->m_petugas->simpan($data);
			} else {
				$this->m_petugas->ubah_simpan($id,$data);
			}
			redirect('app/petugas');
	                
        } else {
            $data = array(
               	'kode_petugas' => $id,
				'nama_petugas' => $nama,
				'gender' => $gender,
				'alamat' => $almt,
				'no_telepon' => $telp,
				'userpic' =>'',
              	'type' =>''
                );

           	if($op=='tambah'){
				$this->m_petugas->simpan($data);
			} else {
				$this->m_petugas->ubah_simpan($id,$data);
			}
			redirect('app/petugas');
        }
	}

	public function p_hapus($data)
	{
		$this->m_petugas->hapus($data);
		redirect('app/petugas');

	}

	public function p_ubah($data)
	{
		$upd['op'] = 'edit';
		$upd['sql'] = $this->m_petugas->ubah($data);
		$this->load->view('petugas/header_petugas');
		$this->load->view('petugas/tambah_petugas',$upd);
		$this->load->view('petugas/footer_petugas');
	}

	public function p_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
	        $data['sql1'] = $this->m_petugas->cari($carijudul);
	        $data['c'] = 'cari';
	        $data['carijudul'] = $carijudul;
			$this->load->view('petugas/header_petugas');
			$this->load->view('petugas/t_petugas',$data);
			$this->load->view('petugas/footer_petugas');
		} else {
			redirect('app/petugas');
		}
	}

	//USER
	public function user()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/user/';
        $config['total_rows'] = $this->db->count_all('user');
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_user->getuser($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

        //load viewnya
        $this->load->view('user/header_user');
		$this->load->view('user/t_user',$data);
		$this->load->view('user/footer_user');
		
	}

	public function u_tambah()
	{
		$data['op'] = 'tambah';
		$this->load->view('user/header_user');
		$this->load->view('user/tambah_user',$data);
		$this->load->view('user/footer_user');

	}

	public function u_simpan()
	{
        //data
        $id=$this->input->post('idpetugas');
        $unama=$this->input->post('username');
        $pass=$this->input->post('password');
        $level=$this->input->post('level');
        $op=$this->input->post('op');

        $data = array(
           	'kode_petugas' => $id,
			'username' => $unama,
			'password' => $pass,
			'level' => $level
            );

        if($op=='tambah'){
			$this->m_user->simpan($data);
		} else {
			$this->m_user->ubah_simpan($unama,$data);
		}
        redirect('app/user');
	}

	public function u_hapus($data)
	{
		$this->m_user->hapus($data);
		redirect('app/user');

	}

	public function u_ubah($data)
	{
		$upd['op'] = 'edit';
		$upd['sql'] = $this->m_user->ubah($data);
		$this->load->view('user/header_user');
		$this->load->view('user/tambah_user',$upd);
		$this->load->view('user/footer_user');
	}

	public function u_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
			$data['sql1']=$this->m_user->cari($carijudul);
			$data['c'] = 'cari';
			$data['carijudul'] = $carijudul;
			$this->load->view('user/header_user');
			$this->load->view('user/t_user',$data);
			$this->load->view('user/footer_user');
		} else {
			redirect('app/user');
		}
	}
	//END OF USER


	//KATEGORI
	public function kategori()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/kategori/';
        $config['total_rows'] = $this->db->count_all('kategori');
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_kategori->getkategori($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

        //load viewnya
        $this->load->view('kategori/header_kategori');
		$this->load->view('kategori/t_kategori',$data);
		$this->load->view('kategori/footer_kategori');
		
	}

	public function k_tambah()
	{
		$data['op'] = 'tambah';
		$this->load->view('kategori/header_kategori');
		$this->load->view('kategori/tambah_kategori',$data);
		$this->load->view('kategori/footer_kategori');

	}

	public function k_simpan()
	{
        $op = $this->input->post('op');
		$id = $this->input->post('idkategori');
		$nama = $this->input->post('namakategori');

		$data = array(
			'kode_kategori' => $id,
			'nama_kategori' => $nama
			 );

		if($op=='tambah'){
			$this->m_kategori->simpan($data);
		} else {
			$this->m_kategori->ubah_simpan($id,$data);
		}
        redirect('app/kategori');
	}

	public function k_hapus($data)
	{
		$this->m_kategori->hapus($data);
		redirect('app/kategori');

	}

	public function k_ubah($data)
	{
		$upd['op'] = 'edit';
		$upd['sql'] = $this->m_kategori->ubah($data);
		$this->load->view('kategori/header_kategori');
		$this->load->view('kategori/tambah_kategori',$upd);
		$this->load->view('kategori/footer_kategori');
	}

	public function k_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
			$data['sql1']=$this->m_kategori->cari($carijudul);
			$data['c'] = 'cari';
			$data['carijudul'] = $carijudul;
			$this->load->view('kategori/header_kategori');
			$this->load->view('kategori/t_kategori',$data);
			$this->load->view('kategori/footer_kategori');
		} else {
			redirect('app/kategori');
		}
	}
	//END OF KATEGORI


	//penerbit
	public function penerbit()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/penerbit/';
        $config['total_rows'] = $this->db->count_all('penerbit');
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_penerbit->getpenerbit($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('penerbit/header_penerbit');
		$this->load->view('penerbit/t_penerbit',$data);
		$this->load->view('penerbit/footer_penerbit');
		
	}

	public function pn_tambah()
	{
		$data['op'] = 'tambah';
		$this->load->view('penerbit/header_penerbit');
		$this->load->view('penerbit/tambah_penerbit',$data);
		$this->load->view('penerbit/footer_penerbit');

	}

	public function pn_simpan()
	{
		$op = $this->input->post('op');
		$id = $this->input->post('idpenerbit');
		$nama = $this->input->post('nama');
		$almt = $this->input->post('alamat');
		$telp = $this->input->post('telp');

		$data = array(
			'kode_penerbit' => $id,
			'nama_penerbit' => $nama,
			'alamat' => $almt,
			'telp' => $telp
			 );

		if($op=='tambah'){
			$this->m_penerbit->simpan($data);
		} else {
			$this->m_penerbit->ubah_simpan($id,$data);
		}

		redirect('app/penerbit');

	}

	public function pn_hapus($data)
	{
		$this->m_penerbit->hapus($data);
		redirect('app/penerbit');

	}

	public function pn_ubah($data)
	{
		$upd['op'] = 'edit';
		$upd['sql'] = $this->m_penerbit->ubah($data);
		$this->load->view('penerbit/header_penerbit');
		$this->load->view('penerbit/tambah_penerbit',$upd);
		$this->load->view('penerbit/footer_penerbit');
	}

	public function pn_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
	        $data['sql1'] = $this->m_penerbit->cari($carijudul);
	        $data['c'] = 'cari';
	        $data['carijudul'] = $carijudul;
			$this->load->view('penerbit/header_penerbit');
			$this->load->view('penerbit/t_penerbit',$data);
			$this->load->view('penerbit/footer_penerbit');
		} else {
			redirect('app/penerbit');
		}
	}

	//peminjam
	public function peminjam()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/peminjam/';
        $config['total_rows'] = $this->db->count_all('peminjam');
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_peminjam->getpeminjam($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('peminjam/header_peminjam');
		$this->load->view('peminjam/t_peminjam',$data);
		$this->load->view('peminjam/footer_peminjam');
		
	}

	public function pm_tambah()
	{
		$data['op'] = 'tambah';
		$this->load->view('peminjam/header_peminjam');
		$this->load->view('peminjam/tambah_peminjam',$data);
		$this->load->view('peminjam/footer_peminjam');

	}

	public function pm_simpan()
	{

        //data
       	$op = $this->input->post('op');
		$id = $this->input->post('idpeminjam');
		$ktp = $this->input->post('ktp');
		$nama = $this->input->post('nama');
		$gender = $this->input->post('gender');
		$almt = $this->input->post('alamat');
		$telp = $this->input->post('telp');
            $data = array(
				'kode_peminjam' =>$id,
				'ktp' =>$ktp,
				'nama' =>$nama,
				'gender' =>$gender,
				'alamat' =>$almt,
				'telp' =>$telp
                );

            if($op=='tambah'){
				$this->m_peminjam->simpan($data);
			} else {
				$this->m_peminjam->ubah_simpan($id,$data);
			}
            redirect('app/peminjam');
	}

	public function pm_hapus($data)
	{
		$this->m_peminjam->hapus($data);
		redirect('app/peminjam');

	}

	public function pm_ubah($data)
	{
		$upd['op'] = 'edit';
		$upd['sql'] = $this->m_peminjam->ubah($data);
		$this->load->view('peminjam/header_peminjam');
		$this->load->view('peminjam/tambah_peminjam',$upd);
		$this->load->view('peminjam/footer_peminjam');
	}

	public function pm_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
	        $data['sql1'] = $this->m_peminjam->cari($carijudul);
	        $data['c'] = 'cari';
	        $data['carijudul'] = $carijudul;
			$this->load->view('peminjam/header_peminjam');
			$this->load->view('peminjam/t_peminjam',$data);
			$this->load->view('peminjam/footer_peminjam');
		} else {
			redirect('app/peminjam');
		}
	}
	//END OF PEMINJAM

	//BEGIN peminjaman
	public function peminjaman()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/peminjaman/';
        $config['total_rows'] = $this->db->count_all('peminjaman');
        $config['per_page'] = "8";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_peminjaman->getpeminjaman($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('peminjaman/header_peminjaman');
		$this->load->view('peminjaman/t_peminjaman',$data);
		$this->load->view('peminjaman/footer_peminjaman');
		
	}

	public function pj_tambah()
	{
		$this->load->view('peminjaman/header_peminjaman');
		$this->load->view('peminjaman/tambah_peminjaman');
		$this->load->view('peminjaman/footer_peminjaman');

	}

	public function pj_simpan()
	{
		$op = $this->input->post('op');
		$id = $this->input->post('idpeminjaman');
		$kdpetugas = $this->input->post('petugas');
		$kdpeminjam = $this->input->post('peminjam');
		$kdkartu = $this->input->post('kartu');
		$kdbuku = $this->input->post('buku');
		$tgl_pinjam = $this->input->post('tglpinjam');
		$tgl_kembali = $this->input->post('tglkembali');

		$data = array(
			'kode_peminjaman' => $id,
			'kode_petugas' => $kdpetugas,
			'kode_peminjam' => $kdpeminjam,
			'kode_kartu' => $kdkartu,
			'kode_buku' => $kdbuku,
			'tgl_pinjam' => $tgl_pinjam,
			'tgl_kembali' => $tgl_kembali,
			'status' => 'Belum');

		$this->m_peminjaman->simpan($data,$hs,$kdbuku);

		redirect('app/peminjaman');

	}

	public function pj_hapus($data)
	{
		$this->m_peminjaman->hapus($data);
		redirect('app/peminjaman');
	}

	public function pj_status($data)
	{
		$qry = mysqli_query($kon,"select * from peminjaman where kode_peminjaman='$data'");
        $hs = mysqli_fetch_array($qry);
		$hs['status'] = 'Sudah';

		$this->m_peminjaman->ubah($data,$hs);
		redirect('app/peminjaman');
	}

	public function pj_cari()
	{
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
			$data['sql1']=$this->m_peminjaman->cari($carijudul);
			$data['c'] = 'cari';
			$data['carijudul'] = $carijudul;
			$this->load->view('peminjaman/header_peminjaman');
			$this->load->view('peminjaman/t_peminjaman',$data);
			$this->load->view('peminjaman/footer_peminjaman');
		} else {
			redirect('app/peminjaman');
		}
	}
	//END OF peminjaman


	//BEGIN kartu
	public function kartu()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/kartu/';
        $config['total_rows'] = $this->db->count_all('kartu');
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_kartu->getkartu($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('kartu/header_kartu');
		$this->load->view('kartu/t_kartu',$data);
		$this->load->view('kartu/footer_kartu');
		
	}

	public function kt_tambah()
	{
		$data['op'] = 'tambah';
		$this->load->view('kartu/header_kartu');
		$this->load->view('kartu/tambah_kartu',$data);
		$this->load->view('kartu/footer_kartu');

	}

	public function kt_ubah($kdkartu)
	{
		$upd['op'] = 'edit';
		$upd['dtkartu'] = $this->m_kartu->ubah($kdkartu);
		$this->load->view('kartu/header_kartu');
		$this->load->view('kartu/tambah_kartu',$upd);
		$this->load->view('kartu/footer_kartu');
	}

	public function kt_simpan()
	{
		$op = $this->input->post('op');
		$kdpeminjam = $this->input->post('peminjam');
		$kdkartu = $this->input->post('idkartu');
		$nama = $this->input->post('nama');
		$password = $this->input->post('password');
		$tglbuat = $this->input->post('tglbuat');
		$tglakhir = $this->input->post('tglakhir');

		if($op == 'tambah') $status='Aktif';
		else $status = $this->input->post('rbstatus');
		
		$data = array(
			'kode_kartu' => $kdkartu,
			'kode_peminjam' => $kdpeminjam,
			'nama' => $nama,
			'tgl_pembuatan' => $tglbuat,
			'tgl_akhir' => $tglakhir,
			'status' => $status,
			'password' => $password);
			// die(var_dump($data));	
			//die(var_dump($this->m_kartu->ubah_simpan($kdkartu,$data)));
		if($op=='tambah') $this->m_kartu->simpan($data);
		else $this->m_kartu->ubah_simpan($kdkartu,$data);

		redirect('app/kartu');

	}

	public function kt_hapus($data)
	{
		$this->m_kartu->hapus($data);
		redirect('app/kartu');
	}

	public function kt_status($data)
	{
		$qry = mysqli_query($kon,"select * from kartu where kode_kartu='$data'");
        $hs = mysqli_fetch_array($qry);
		$hs['status'] = 'Aktif';

		$this->m_kartu->ubah($data,$hs);
		redirect('app/kartu');
	}

	public function kt_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
			$data['sql1']=$this->m_kartu->cari($carijudul);
			$data['c'] = 'cari';
			$data['carijudul'] = $carijudul;
			$this->load->view('kartu/header_kartu');
			$this->load->view('kartu/t_kartu',$data);
			$this->load->view('kartu/footer_kartu');
		} else {
			redirect('app/kartu');
		}
	}

	public function kt_cetak($caricetak)
	{
		$data['sql1'] = $this->m_kartu->caricetak($caricetak);

		$this->load->view('kartu/ckartu',$data);
	}
	//END OF KARTU

	public function laporan(){
		$this->load->view('laporan/header_laporan');
		$this->load->view('laporan/t_laporan');
		$this->load->view('laporan/footer_laporan');
	}

	// START PEMINJAMAN ONLINE
	public function peminjaman_online()
	{
		//pagination setting
		$config['base_url'] = base_url().'app/peminjaman_online/';
        $config['total_rows'] = $this->db->count_all('peminjaman_online');
        $config['per_page'] = "8";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //configurasi untuk bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //mengambil data melalui model 
        $data['sql1'] = $this->m_peminjamanonline->getpeminjamanonline($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('peminjaman_online/header_peminjaman_online');
		$this->load->view('peminjaman_online/t_peminjaman_online',$data);
		$this->load->view('peminjaman_online/footer_peminjaman_online');
	}

	public function pjonline_hapus($data)
	{
		$this->m_peminjamanonline->hapus($data);
		redirect('app/peminjaman_online');
	}

	public function pjonline_status($idpeminjamanonline)
	{
		//get data from peminjaman online 
		$pjonline_rs = $this->db->get_where('peminjaman_online', array('sha1(md5(id_peminjaman_online))' => $idpeminjamanonline));
		$row = $pjonline_rs->row();

		//get kdpemnijam
		$peminjam_rs = $this->db->query('select kode_peminjam from kartu where kode_kartu = "'.$row->kode_kartu.'"');
		$row2 = $peminjam_rs->row();

		//get kdpetugas
		$petugas_rs = $this->db->query('select kode_petugas from user where username = "'.$this->session->userdata('username').'"');
		$row3 = $petugas_rs->row();

		//get tgl pinjam and tgl_kembali
		date_default_timezone_get('asia/jakarta');
		$tanggal_now = date('Y-m-d');
		$tambah = mktime(0,0,0,date('m')+0,date('d')+3,date('Y')+0);
		$tbh = date('Y-m-d',$tambah);

		$id = $this->generate_idpeminjaman();
		$kdpetugas = $row3->kode_petugas;
		$kdpeminjam = $row2->kode_peminjam;
		$kdkartu = $row->kode_kartu;
		$kdbuku = $row->kode_buku;
		$tgl_pinjam = $tanggal_now;
		$tgl_kembali = $tbh;

		$data = array(
			'kode_peminjaman' => $id,
			'kode_petugas' => $kdpetugas,
			'kode_peminjam' => $kdpeminjam,
			'kode_kartu' => $kdkartu,
			'kode_buku' => $kdbuku,
			'tgl_pinjam' => $tgl_pinjam,
			'tgl_kembali' => $tgl_kembali,
			'status' => 'Belum');

		$this->m_peminjaman->simpan($data,$hs,$kdbuku);
		$this->pjonline_hapus($idpeminjamanonline);
		redirect('app/peminjaman_online');
	}

	public function pjonline_cari(){
		$carijudul = $this->input->post('cari');
		if (isset($carijudul) and !empty($carijudul)){
			$data['sql1']=$this->m_peminjamanonline->cari($carijudul);
			$data['c'] = 'cari';
			$data['carijudul'] = $carijudul;
			$this->load->view('peminjaman_online/header_peminjaman_online');
			$this->load->view('peminjaman_online/t_peminjaman_online',$data);
			$this->load->view('peminjaman_online/footer_peminjaman_online');
		} else {
			redirect('app/peminjaman_online');
		}
	}

	function generate_idpeminjaman(){
		$qry =  $this->db->query("select * from peminjaman order by kode_peminjaman desc limit 1");
		if($qry->num_rows()>0){
			$row =  $qry->row();
			// die(var_dump($row[0]));
			$kd_peminjaman   = substr($row->kode_peminjaman, -4);
			$kd_peminjaman=$kd_peminjaman+1;
			if(strlen($kd_peminjaman)==1) {$kd_peminjaman='000'.$kd_peminjaman;}
			else if(strlen($kd_peminjaman)==2) {$kd_peminjaman='00'.$kd_peminjaman;}
			else if(strlen($kd_peminjaman)==3) {$kd_peminjaman='0'.$kd_peminjaman;}
			else {$kd_peminjaman=$kd_peminjaman;}
			$idpeminjaman=  date('ymd').$kd_peminjaman;

		} else {
			$idpeminjaman=  date('ymd').'0001';
		}
		return $idpeminjaman;
	}
}

