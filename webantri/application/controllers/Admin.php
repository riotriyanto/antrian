<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
        parent::__construct();
        if ($this->session->userdata('level') != 1) {
        	redirect('rtlogin');
        }

    }
	public function api($value='')
  	{
  		$data['api'] = $this->config->base_url();
		$data['api'] = substr($data['api'], 0, 33);
		return $data['api'];
  	}
	public function index($value='')
	{
		$data['title'] = 'Dashboard';
		$data['judul']= $data['title'];
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/dash');
		// $this->load->view('admin/view/layanan');
		$this->load->view('admin/footer');
	}
	public function layanan($value='')
	{
		$data['title'] = 'Manajemen Layanan';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/layanan');
		$this->load->view('admin/footer');
	}

	public function loket($value='')
	{
		$data['title'] = 'Manajemen Layanan';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/loket/loket');
		$this->load->view('admin/footer');
	}
	public function user($value='')
	{
		$data['title'] = 'Manajemen Layanan';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/user/user');
		$this->load->view('admin/footer');
	}
	public function waktu($value='')
	{
		$data['title'] = 'Manajemen Layanan';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/waktu/waktu');
		$this->load->view('admin/footer');
	}
	public function maksimakAntrian($value='')
	{
		$data['title'] = 'Maksimal Antrian';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/antrian/maksimal');
		$this->load->view('admin/footer');
	}
	public function gambarAndroid($value='')
	{
		$data['title'] = 'Gambar Android';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/android/gambar');
		$this->load->view('admin/footer');
	}
	public function maksimalJarak($value='')
	{
		$data['title'] = 'Gambar Android';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/antrian/jarak');
		$this->load->view('admin/footer');
	}
	public function notif($value='')
	{
		$data['title'] = 'Gambar Android';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/android/notif');
		$this->load->view('admin/footer');
	}
	public function aplikasi($value='')
	{
		$data['title'] = 'Pengaturan Aplikasi';
		$data['api'] = $this->api();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/menu');
		$this->load->view('admin/close_menu');
		$this->load->view('admin/view/pengaturan/aplikasi');
		$this->load->view('admin/footer');
	}
}