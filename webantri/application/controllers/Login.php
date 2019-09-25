<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
        parent::__construct();
        
  	}
  	public function url_api($value='')
  	{
  		$data['api'] = $this->config->base_url();
		$data['api'] = substr($data['api'], 0, 33);
		return $data['api'];
  	}
	public function index($value='')
	{
		$this->load->view('login/login');
	}
	public function proses_login($value='')
	{
		$url_api = $this->url_api()."login.php";
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'POST',
		        'header' => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
		            array(
		                'nik' => $this->input->post('nik'),
		                'password' => $this->input->post('password')
		            )
		        ),
		        'timeout' => 60
		    )
		));

		$resp = file_get_contents($url_api, FALSE, $context);
		// print_r($resp);
		$data = json_decode($resp, true);
		// print_r($data);
		if ($data['status']) {
			$userdat = array(
						'nama' => $data['nama'],
						'id_user' => $data['id_user'],
						'level' => $data['level']
					);
			$this->session->set_userdata($userdat);
			if ($data['level'] == 1) {
				redirect('admin');
			}elseif($data['level'] == 2){
				redirect('cs');
			}elseif($data['level'] == 3){
				redirect('operator');
			}else{
				$this->session->set_flashdata('warning', 'Akses ditolak');
				redirect('rtlogin');
			}
		}else{
			$this->session->set_flashdata('warning', '"'.$data['pesan'].'"');
			redirect('rtlogin');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('rtlogin');
	}
}
?>