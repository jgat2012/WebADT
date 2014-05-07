<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['hide_menu']='';
		$data['hide_sidemenu']='';
		$data['content_view'] = 'user/login';
		echo Modules::run('template/template/default_load',$data);
	}

}
