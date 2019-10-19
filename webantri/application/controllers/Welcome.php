<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function api($value='')
  	{
  // 		$data['api'] = $this->config->base_url();
		// $data['api'] = substr($data['api'], 0, 33);
		// return $this->api_c();
		return $this->config->item('api');
  	}
	public function index()
	{
		// $data['api'] = "http://103.100.27.19/api_antrian/";
		// $data['api'] = $this->config->base_url();
		// $data['api'] = substr($data['api'], 0, 33);
		$data['api'] = $this->api();
		$this->load->view('client/index', $data);
	}
	public function prosesPilihLayanan($value='')
	{
		// echo $this->input->post('id_layanan').", ".$this->input->post('jenis_layanan');
		if (!empty($this->input->post('id_layanan'))) {
			$sesdata = array(
	            'id_layanan'  => $this->input->post('id_layanan'),
	            'nama_layanan'  => $this->input->post('jenis_layanan')
	        );
			$this->session->set_userdata($sesdata);
			redirect('isidata');
		}
		// $data['api'] = "http://103.100.27.19/api_antrian/";
		// $this->load->view('client/form');
	}
	public function isidata($value='')
	{
		$data['api'] = $this->api();
		$this->load->view('client/form', $data);
	}
	public function ambilAntrian($value='')
	{
		// $data['api'] = "http://103.100.27.19/api_antrian/";
		$data['api'] = $this->api();
		$data = array(
				'id_layanan' => $this->input->post('id_layanan'),
				'nik' => $this->input->post('NIK'),
				'nama' => $this->input->post('nama'),
				'no_telp' => $this->input->post('no_telp'),
				'api' => $data['api']
			);
		$this->load->view('client/ambilAntrian',$data);
	}
	public function panggil($value='')
	{
		// $data['api'] = "http://103.100.27.19/api_antrian/";
		$data['api'] = $this->api();
		$this->load->view('client/panggil',$data);
	}
}
