<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	function __construct(){
		parent::__construct();

		$this->load->model(array('M_user'));
		$this->load->helper(array('captcha'));
		if($this->session->userdata('nama')){
			redirect('absen');
		}
	}

	public function index()
	{
		$vals = array(
			'img_path'      => './assets/captcha/',
			'img_url'       => base_url().'/assets/captcha/',
			//'font_path'     => './path/to/fonts/texb.ttf',
			'font_path'     => FCPATH.'system/fonts/texb.ttf',
			'img_width'     => '250',
			'img_height'    => 55,
			'expiration'    => 7200,
			'word_length'   => 4,
			'font_size'     => 28,
			'pool'          => '0123456789',

			// White background and border, black text and red grid
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);

		$cap = create_captcha($vals);
		$capword=md5(strtolower($cap['word']));
		$data['captcha_img'] = $cap['image'];

		$this->load->view('V_login',$data);
	}

	function proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','password','required');
		$ip=$_SERVER['REMOTE_ADDR'];

		$username = strtoupper($this->input->post('username'));
		$password = $this->input->post('password');
		$login_data = $this->M_user->cek_user_login($username, $password);
		if ($login_data == TRUE)
		{
			$session_data = array
			(
				'user' => $login_data['nik'],
				'nama' => $login_data['username'],
				'lvl' => $login_data['level_akses'],
				'nik' => $login_data['nik'],
				'loccode' => $login_data['loccode'],
				'roleid' => $login_data['roleid'],
				'site_lang' => trim($login_data['lang']),
			);
			$log_data=array(
				'nik' => trim($login_data['nik']),
				'tgl'=>date("Y-m-d H:i:s"),
				'ip'=>$ip
			);
			$this->session->set_userdata($session_data);
			$this->db->insert("sc_log.log_time",$log_data);
			$identity=trim($login_data['username']);
			$session_id = $this->session->userdata('session_id');
			$this->db->where('session_id', $session_id);
			$this->db->update('osin_sessions', array('userid' => $identity));

			redirect('absen');

		}else{
			//login gagal
			$this->session->set_flashdata('message','Username atau password salah');
			redirect('login');
		}
	}




}
