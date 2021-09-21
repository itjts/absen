<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {

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
		if(!$this->session->userdata('nama')){
			redirect('login');
		}

	}

	public function index()
	{

// now try it
		$ua=$this->getBrowser();
		$yourbrowser= "Browser: " . $ua['name'] . " " . $ua['version'] ." Reports: " . str_replace('Mozilla/5.0','',$ua['userAgent']);
		$data['nama']=trim($this->session->userdata('nama'));
		$data['yourbrowser']=$yourbrowser;
		$nama = trim($this->session->userdata('nama'));
		$data['dtl'] = $this->M_user->q_karyawan(" and nik='".$data['nama']."'")->row_array();
		$this->load->view('V_absen',$data);
	}

	function getBrowser()
	{
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'Linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'Mac';
		}
		elseif (preg_match('/windows|Win32/i', $u_agent)) {
			$platform = 'Windows 32';
		}
		elseif (preg_match('/windows|win64/i', $u_agent)) {
			$platform = 'Windows 64';
		}
		elseif (preg_match('/linux|android/i', $u_agent)) {
			$platform = 'Windows 64';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}

		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
			')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}

		// check if we have a number
		if ($version==null || $version=="") {$version="?";}

		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}

	function saveOnlineAbsen()
	{
		$nama = trim($this->session->userdata('nama'));
		$lang = trim($this->input->post('lang'));
		$long = trim($this->input->post('long'));
		$ctype = trim($this->input->post('ctype'));
		$browser = trim($this->input->post('browser'));
		$alamat = trim($this->input->post('alamat'));
		$dusun = trim($this->input->post('dusun'));
		$desa = trim($this->input->post('desa'));
		$kota = trim($this->input->post('kota'));
		$kabupaten = trim($this->input->post('kabupaten'));
		$provinsi = trim($this->input->post('provinsi'));
		$negara = trim($this->input->post('negara'));
		$kodepos = trim($this->input->post('kodepos'));
		// Function to get the client IP address

		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
		{$ipaddress = $_SERVER['HTTP_CLIENT_IP'];}
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];}
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
		{$ipaddress = $_SERVER['HTTP_X_FORWARDED'];}
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		{$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];}
		else if(isset($_SERVER['HTTP_FORWARDED']))
		{$ipaddress = $_SERVER['HTTP_FORWARDED'];}
		else if(isset($_SERVER['REMOTE_ADDR']))
		{$ipaddress = $_SERVER['REMOTE_ADDR'];}
		else
		{$ipaddress = 'UNKNOWN';}


		$inputdate = date('Y-m-d H:i:s');
		$inputby = $nama;

		$path = "./assets/files/onlineabsen";
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		$img = $this->input->post('photoimage');
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$filename = uniqid().uniqid() . '.png';
		//$file = $path.'/'. $filename;
		//$success = file_put_contents($file, $data);

		if ($img) {
			$info = array (
				'nik' => $nama,
				'ctype' => $ctype,
				'checktime' => $inputdate,
				'lang' => $lang,
				'long' => $long,
				'ip' => $ipaddress,
				'inputdate' => $inputdate,
				'inputby' => $inputby,
				'image' => $filename,
				'imageblob' => $this->input->post('photoimage'),
				'browser' => $browser,
				'alamat' => $alamat,
				'dusun' => $dusun,
				'desa' => $desa,
				'kota' => $kota,
				'kabupaten' => $kabupaten,
				'provinsi' => $provinsi,
				'negara' => $negara,
				'kodepos' => $kodepos,
			);
			$this->db->insert('sc_tmp.onlineabsen',$info);
			//$result = array('status' => true, 'messages' => 'Lokasi Anda : '.$lang.' , '.$long);
			//$result = array('status' => true, 'messages' => 'Checkin : '.date('d-m-Y H:i:s',strtotime($inputdate)));

			if (($ctype==='R-IN') or ($ctype==='R-OUT'))  {
				if ( ($ctype==='R-OUT')) {
					$result = array('title' => 'AKHIR ISTIRAHAT','status' => true, 'messages' => '<p> <div style="font-size:20px">'.date('d-m-Y H:i:s',strtotime($inputdate)).'<br><br>'. '<div style="font-size:17px">Lokasi Anda : '.'<br>'.$alamat.'</div></p>');
				} else {
					$result = array('title' => 'MULAI ISTIRAHAT','status' => true, 'messages' => '<p> <div style="font-size:20px">'.date('d-m-Y H:i:s',strtotime($inputdate)).'<br><br>'. '<div style="font-size:17px">Lokasi Anda : '.'<br>'.$alamat.'</div></p>');
				}
			} else {
				if ( ($ctype==='OUT')) {
					$result = array('title' => 'PULANG','status' => true, 'messages' => '<p> <div style="font-size:20px">'.date('d-m-Y H:i:s',strtotime($inputdate)).'<br><br>'. '<div style="font-size:17px">Lokasi Anda '.'<br>'.$alamat.'</div></p>');
				} else {
					$result = array('title' => 'MASUK','status' => true, 'messages' => '<p> <div style="font-size:20px">'.date('d-m-Y H:i:s',strtotime($inputdate)).'<br><br>'. '<div style="font-size:17px">Lokasi Anda '.'<br>'.$alamat.'</div></p>');
				}

			}

			echo json_encode($result);
		} else {
			$result = array('status' => false, 'messages' => 'Data Gagal Memuat Lokasi');
			echo json_encode($result);
		}

	}

	function logout(){
		$nama = trim($this->session->userdata('nama'));
		$id = trim($this->session->userdata('session_id'));
		//$this->session->unset_userdata('session_id');
		//$this->session->sess_destroy();

		$this->db->query("delete from osin_sessions where trim(userid)='$nama'");

		//$this->db->where('userid',trim($this->session->userdata('nama')));
		//$this->db->delete('osin_sessions');
		//$this->session->unset_userdata('session_id');
		//$this->session->sess_destroy();

		redirect('login');
	}

}
