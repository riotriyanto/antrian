<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cs extends CI_Controller {
	public function ceklogin($value='')
	{
		if (empty($this->session->userdata('nama'))) {
			 return redirect('rtlogin');
		}elseif($this->session->userdata('level') != 2){
			return redirect('rtlogin');
		}
	}
	public function api($value='')
  	{
  		return $this->config->item('api');
  	}
	public function logout(){
		$id_loket = $this->session->userdata('id_loket');
		$url2 = $this->api().'cs/logout_loket.php';

		    $context2 = stream_context_create(array(
		    'http' => array(
		        'method' => 'POST',
		        'header' => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
		            array(
		                'id_loket' => $id_loket
		            )
		        ),
		        'timeout' => 60
		        )
		    ));
		    $resp2 = file_get_contents($url2, FALSE, $context2);
		$this->session->sess_destroy();
		redirect('rtlogin');
	}
	public function index($value='')
	{
		if (!empty($this->session->userdata('id_loket'))) {
			$this->session->set_flashdata('warning', 'Anda harus logout untuk memilih loket kembali!');
			redirect('cs/layanan');
		}
		$this->ceklogin();
		$data['api'] = $this->api();
		$this->load->view('cs/piliLoket', $data);
	}
	public function transLoket($value='')
	{
		// echo $this->input->post('id_loket').", no:".$this->input->post('nomor_loket');
		$userdat = array(
						'id_loket' => $this->input->post('id_loket'),
						'nama_loket' => $this->input->post('nomor_loket')
					);
		$context = stream_context_create(array(
	    'http' => array(
	        'method' => 'POST',
	        'header' => 'Content-type: application/x-www-form-urlencoded',
	        'content' => http_build_query(
	            array(
	                'id_user' => $this->session->userdata('id_user'),
	                'id_loket' => $this->input->post('id_loket')
	            )
	        ),
	        'timeout' => 60
		    )
		));
	    //loginloket
	    
	    //endloginloket
	    $urlq = $this->api()."cs/transaksi_loket.php";
		$resp = file_get_contents($urlq, FALSE, $context);
		// print_r($resp);
	    $data = json_decode($resp, true);
		// if ($data['status']) {
		// 	$this->session->set_userdata($userdat);
		// 	redirect('cs/layanan');
		// }
		if ($data['status'] == 1) {
	        $url2 = $this->api().'cs/login_loket.php';

	        $context2 = stream_context_create(array(
	        'http' => array(
	            'method' => 'POST',
	            'header' => 'Content-type: application/x-www-form-urlencoded',
	            'content' => http_build_query(
	                array(
	                    'id_loket' => $this->input->post('id_loket')
	                )
	            ),
	            'timeout' => 60
	            )
	        ));
	        $resp2 = file_get_contents($url2, FALSE, $context2);
	         $data2 = json_decode($resp2, true);
	         if ($data2['status']) {
	         	$this->session->set_userdata($userdat);
	        	redirect('cs/layanan');
	         }else{
	         	$this->session->set_flashdata('warning', ''.$data2['pesan'].'');
	         	redirect('cs');
	         }
	        
	    }else{
	        redirect('cs');
	    }
	}
	public function layanan()
	{
		$data['api'] = $this->api();
		$this->load->view('cs/layanan', $data);
	}
	public function ptransaksi($value='')
	{
		echo $this->input->post('id_layanan');
		$userdat = array(
						'id_layanan' => $this->input->post('id_layanan'),
						'jenis_layanan' => $this->input->post('jenis_layanan')
					);
		$this->session->set_userdata($userdat);
		// print_r($userdat);
		redirect('cs/transaksi');
	}
	public function transaksi($value='')
	{
		$data['api'] = $this->api();
		$this->load->view('cs/transaksi', $data);
	}

	public function ptransaksiTerlewat($value='')
	{
		echo $this->input->post('id_layanan');
		$userdat = array(
						'id_layanan' => $this->input->post('id_layanan'),
						'jenis_layanan' => $this->input->post('jenis_layanan')
					);
		$this->session->set_userdata($userdat);
		redirect('cs/transaksiTerlewati');
	}
	public function transaksiTerlewati($value='')
	{
		$data['api'] = $this->api();
		$this->load->view('cs/transaksiTerlewati', $data);
	}
}
