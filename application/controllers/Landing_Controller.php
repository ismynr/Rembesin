<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index(){
		$this->load->model('jenis_nota_model');
		$jNota = $this->jenis_nota_model->getAll_jNota_ldg();
		$countJNota = $this->jenis_nota_model->countAll_jNota_ldg();
     	$data['getJenisNota'] = $jNota;
     	$data['countJenisNota'] = $countJNota;
     	$this->load->view('landing_page/index',$data);
	}

	public function _sendEmail($name, $email, $phone, $messageUser){
		$this->load->library('email');
	    $config = array();
	    $config['charset'] = 'utf-8';
	    $config['useragent'] = 'Codeigniter';
	    $config['protocol']= "smtp";
	    $config['mailtype']= "html";
	    $config['smtp_host']= "ssl://smtp.googlemail.com";//pengaturan smtp
	    $config['smtp_port']= "465";
	    $config['smtp_timeout']= "400";
	    $config['smtp_user']= "rembesin.rembes@gmail.com"; // isi dengan email kamu
	    $config['smtp_pass']= "gantiin123"; // isi dengan password kamu
	    $config['crlf']="\r\n"; 
	    $config['newline']="\r\n"; 
	    $config['wordwrap'] = TRUE;	

	    $message = "
			Name  : ".$name."<br>
			Email : ".$email."<br>
			Phone : ".$phone."<br><br>
			Pesan : ".$messageUser."<br>
	    ";
	    $this->email->initialize($config);
	    $this->email->from("$email", "REMBESIN Contact Form $name");
	    $this->email->to($this->config->item('EMAIL_KONTAK'));
	    $this->email->subject("Contact Support, New Message Received");
	    $this->email->message($message);

	    if($this->email->send()){
	       return true;
	    }else{
	       return false;
	    }
	}
	public function contact_us(){
		$this->form_validation->set_rules('name','Nama','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('phone','No Telepon','trim|required|numeric');
		$this->form_validation->set_rules('message','Pesan','trim|required');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$message = $this->input->post('message');

		if($this->form_validation->run() == false){
			$this->index();
			$this->session->set_flashdata('success', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Masukan data dengan benar!</div>');
		} else {
			if($this->_sendEmail($name, $email, $phone, $message) == true){
				$this->session->set_flashdata('success', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Pesan anda telah dikirimkan!</div>');	
			}else{
				$this->session->set_flashdata('success', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Server error!</div>');	
			}
			
		}
		redirect('/#contact');
	}
}
