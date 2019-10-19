<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {
	public function index($value='')
	{
		if (empty($this->session->userdata('nama'))) {
			redirect('rtlogin');
		}elseif($this->session->userdata('level') != 3){
			redirect('rtlogin');
		}
		// $data['api'] = "http://103.100.27.19/api_antrian/";
		$data['api'] = $this->config->base_url();
		$data['api'] = substr($data['api'], 0, 33);
		
		$this->load->view('op/op', $data);
	}
}