<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index(){
		if($this->session->userdata('username')){
			$id_role = $this->session->userdata('id_role');
			if($id_role == '1'){
				redirect('admin');
			}elseif($id_role == '2'){
				redirect('perusahaan');
			}else{
				redirect('karyawan');
			}
		}
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		if($this->form_validation->run() == false){
			$data['title'] = 'Login';
			$this->load->view('auth/templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('auth/templates/auth_footer');
		} else {
			//jika validasinya sukses
			$this->_login();
		}
	}

	public function _login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$num_user = $this->db->get_where('tb_user',array('username' => $username))->num_rows();
		$val_user = $this->db->get_where('tb_user',array('username' => $username))->row();
		if($num_user > 0) {
			if(password_verify($password, $val_user->password)){
				if($val_user->id_role == "1"){
					$session = [
					'id_user' => $val_user->id_user ,
					'username' => $val_user->username ,
					'id_role' => $val_user->id_role
					];
					$this->session->set_userdata($session);
					//UPDATE TIME LOGIN
					$update_logged_at = [
						'logged_at' => date('Y-m-d H:i:s')
					];
					activity_log("user", "login", $this->session->userdata('username'));
					$this->db->update('tb_user', $update_logged_at, ['id_user'=>$this->session->userdata('id_user')]);
					redirect('admin');
				}elseif($val_user->id_role == "2"){
					$val_perusahaan = $this->db->get_where('tb_perusahaan',array('id_user' => $val_user->id_user))->row();
					if($val_perusahaan->approvment == "1" && $val_perusahaan->trash == "0") {
						$session = [
						'id_user' => $val_user->id_user ,
						'username' => $val_user->username ,
						'id_role' => $val_user->id_role
						];
						$this->session->set_userdata($session);
						//UPDATE TIME LOGIN
						$update_logged_at = [
							'logged_at' => date('Y-m-d H:i:s')
						];
						activity_log("user", "login", $this->session->userdata('username'));
						$this->db->update('tb_user', $update_logged_at, ['id_user'=>$this->session->userdata('id_user')]);
						redirect('perusahaan');
					}elseif($val_perusahaan->approvment == "1" && $val_perusahaan->trash == "1"){
						$this->session->set_flashdata('message','<div class="alert alert-danger" role = "alert"> This username has been deleted OR blacklisted!  <br><small>please contact admin</small></div>');
						redirect('auth/login');
					} else {
						$this->session->set_flashdata('message','<div class="alert alert-danger" role = "alert"> This username has not been activated!  </div>');
						redirect('auth/login');
					}
				}
				elseif($val_user->id_role == "3"){
					$val_karyawan = $this->db->get_where('tb_karyawan',array('id_user' => $val_user->id_user))->row();
					$getPerusahaanKaryawan = $this->db->get_where('tb_perusahaan',['id_perusahaan' => $val_karyawan->id_perusahaan])->row();
					if($getPerusahaanKaryawan->approvment == "1" && $getPerusahaanKaryawan->trash == "1"){
						$this->session->set_flashdata('message','<div class="alert alert-danger" role = "alert"> You Can\'t Login !  Because your company has been deleted OR blacklisted! <br><small>please contact admin or your company</small></div>');
						redirect('auth/login');
					}elseif($getPerusahaanKaryawan->approvment == "0"){
						$this->session->set_flashdata('message','<div class="alert alert-danger" role = "alert"> You Can\'t Login !  Because your company has been Disapprove! <br><small>please contact admin or your company</small></div>');
						redirect('auth/login');
					}else{
						$session = [
						'id_user' => $val_user->id_user ,
						'username' => $val_user->username ,
						'id_role' => $val_user->id_role
						];
						$this->session->set_userdata($session);
						//UPDATE TIME LOGIN
						$update_logged_at = [
							'logged_at' => date('Y-m-d H:i:s')
						];
						activity_log("user", "login", $this->session->userdata('username'));
						$this->db->update('tb_user', $update_logged_at, ['id_user'=>$this->session->userdata('id_user')]);
						redirect('karyawan');
					}
				}else{}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role = "alert">Wrong password!</div>');
				redirect('auth/login');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role = "alert"> Username is not Registered!</div>');
			redirect('auth/login');
		}
	}
	public function registrasi(){
		if($this->session->userdata('username')){
			$id_role = $this->session->userdata('id_role');
			if($id_role == '1'){
				redirect('admin');
			}elseif($id_role == '2'){
				redirect('perusahaan');
			}else{
				redirect('karyawan');
			}
		}
		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_perusahaan.email_perusahaan]|is_unique[tb_karyawan.email_karyawan]|is_unique[tb_admin.email]',['is_unique' => 'This email has already registered!']);

		$this->form_validation->set_rules('no_hp', 'No_hp', 'required|trim|numeric|is_unique[tb_perusahaan.no_telepon]',['is_unique' => 'This no_telepon has already registered!']);

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]',['is_unique' => 'This username has already registered!']);

		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password dont match !', 
			'min_length' => 'Password to sort !']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password]');


		if($this->form_validation->run() == false){
			$data['title'] = 'Registrasi Akun';
			$this->load->view('auth/templates/auth_header', $data);
			$this->load->view('auth/registrasi');
			$this->load->view('auth/templates/auth_footer');
		}else{
			$nowDateTime = date('Y-m-d H:i:s');

			$data_user = [
				'username' => htmlspecialchars($this->input->post('username',true)),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT) ,
				'id_role' => '2',
				'created_at' => $nowDateTime,
				'updated_at' => $nowDateTime
			];
			if($this->db->insert('tb_user',$data_user)){
				$u = htmlspecialchars($this->input->post('username',true));
				$get_id_user = $this->db->get_where('tb_user',array('username' => $u))->row();
				$data = [
					'id_user' => $get_id_user->id_user,
					'nama_perusahaan' => htmlspecialchars($this->input->post('perusahaan',true)),
					'email_perusahaan' => htmlspecialchars($this->input->post('email',true)),
					'no_telepon' => htmlspecialchars($this->input->post('no_hp',true)),
					'alamat_perusahaan' => htmlspecialchars($this->input->post('alamat',true)),
					'approvment' => '0',
					'created_at' => $nowDateTime,
					'updated_at' => $nowDateTime
				];
				if($this->db->insert('tb_perusahaan',$data)){
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Selamat! Registrasi Anda Berhasil, </div>');
					redirect('auth/login');
				}
				$this->db->delete('tb_user',['username'=>$u]);
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Failed</div>');
				redirect('auth/registrasi');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">failed</div>');
				redirect('auth/registrasi');
			}
			// $this->_sendEmail($token, 'verify');
		}
	}

	private function _sendEmail($token, $type){
	    $this->load->library('email');
	    $config = array();
	    $config['charset'] = 'utf-8';
	    $config['useragent'] = 'Codeigniter';
	    $config['protocol']= "smtp";
	    $config['mailtype']= "html";
	    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
	    $config['smtp_port']= "465";
	    $config['smtp_timeout']= "400";
	    $config['smtp_user']= "rembesin.rembes@gmail.com"; // isi dengan email kamu
	    $config['smtp_pass']= "gantiin123"; // isi dengan password kamu
	    $config['crlf']="\r\n"; 
	    $config['newline']="\r\n"; 
	    $config['wordwrap'] = TRUE;
	    $this->email->initialize($config);
	    $this->email->from("rembesin.rembes@gmail.com", 'REMBESIN');
	    $this->email->to("ismynr.xyz@gmail.com");
	    if($type == 'verify'){
	    	$this->email->subject("Verifikasi Akun");
	    	$this->email->message(
	    		"Terimakasih telah melakuan registrasi, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>
				<a href='".site_url('auth/verify?email=').$this->input->post('email')."&token=".$token."'>Activate</a>
	    		");
	    }elseif($type == 'forgot'){
	    	$this->email->subject("Reset Password");
	    	$this->email->message(
	    		"Klik link dibawah ini untuk reset password<br><br>
				<a href='".site_url('auth/resetPassword?email=').$this->input->post('email')."&token=".urlencode($token)."'>Reset</a>
	    		");
	    }
	    if($this->email->send()){
	       return true;
	    }else{
	       return false;
	    }
	}

	public function logout(){
		if (!$this->session->userdata('username')) {
			redirect('auth/login');
		}else{
			activity_log("user", "logout", $this->session->userdata('username'));
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('role_id');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Logout !</div>');
			redirect('auth/login');
		}
	}

	public function blocked(){
		$data['title'] = '403';
		$this->load->view('auth/templates/auth_header', $data);
		$this->load->view('auth/user_blocked');
		$this->load->view('auth/templates/auth_footer');
	}
	public function forgotPassword(){
		$nowDateTime = date('Y-m-d H:i:s');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

		if($this->form_validation->run() == false){
			$data['title'] = 'Lupa Password';
			$this->load->view('auth/templates/auth_header', $data);
			$this->load->view('auth/forgot_password');
			$this->load->view('auth/templates/auth_footer');
		}else{
			$email = $this->input->post('email');
			$user = $this->db->get_where('tb_perusahaan', ['email_perusahaan'=>$email,'approvment'=>'1'])->row_array();
			if($user){
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'token' => $token,
					'email' => $email,
					'created_at'=> $nowDateTime
				];
				activity_log("user", "forgot password", getById('tb_user','WHERE id_user="'.$user->id_user.'"'));
				$this->db->insert('tb_user_token', $user_token);

				if($this->_sendEmail($token, 'forgot') == true){
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Username dan Password telah dikirim ke email silahkan cek email anda!</div>');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar atau sudah tidak aktif!</div>');
				}
			}else{
				redirect('auth/forgot_password');
			}
			redirect('auth/forgot_password');
		}
	}
	public function resetPassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$query = $this->db->get_where('tb_perusahaan', ['email_perusahaan'=>$email,'approvment'=>'1','trash'=>'0']);

		$user = $query->row_array();
		$getPerusahaan = $query->row();
		$getUser = $this->db->get_where('tb_user',['id_user'=>$getPerusahaan->id_user])->row();

		if($user){
			$user_token = $this->db->get_where('tb_user_token',['token'=>$token])->row_array();
			if($user_token){
				$this->session->set_userdata('reset_email', $email);
				$this->session->set_userdata('username', $getUser->username);
				$this->changePassword();
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password gaga! token tidak ada</div>');
				redirect('auth/login');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password gagal! Email tidak ada</div>');
			redirect('auth/login');
		}
	}
	public function changePassword(){
		if(! $this->session->userdata('reset_email')){
			redirect('auth/login');
		}
		$nowDateTime = date('Y-m-d H:i:s');

		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password dont match !', 
			'min_length' => 'Password to sort !']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password]');
		
		if($this->form_validation->run() == false){
			$data['title'] = 'Ganti Password';
			$this->load->view('auth/templates/auth_header', $data);
			$this->load->view('auth/change_password');
			$this->load->view('auth/templates/auth_footer');
		}else{
			$password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');
			$getPerusahaan = $this->db->get_where('tb_perusahaan', ['email_perusahaan'=>$email,'approvment'=>'1','trash'=>'0'])->row();
			$data = [
				'password' => $password
			];
			$this->db->update('tb_user',$data, ['id_user'=>$getPerusahaan->id_user]);
			$this->session->unset_userdata('reset_email');
			$this->session->unset_userdata('username');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diubah! silahkan login</div>');
			redirect('auth/login');
		}
	}
}
