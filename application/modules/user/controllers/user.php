<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['hide_menu']='';
		$data['hide_sidemenu']='';
		$data['content_view'] = 'user/login';
		$data['title'] = 'webADT | Login';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}
	
	public function forgot_pass(){//load Forgot password view
		$data['hide_menu']='';
		$data['hide_sidemenu']='';
		$data['content_view'] = 'user/forgot_password';
		$data['title'] = 'webADT | Forgot Password';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}

}
