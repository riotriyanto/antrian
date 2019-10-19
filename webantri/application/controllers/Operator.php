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
		return $this->config->item('api');
		
		$this->load->view('op/op', $data);
	}
}