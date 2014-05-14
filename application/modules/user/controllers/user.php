<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['hide_menu'] = '';
		$data['hide_sidemenu'] = '';
		$data['content_view'] = 'user/login';
		$data['title'] = 'webADT | Login';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}

	public function forgot_pass() {//load Forgot password view
		$data['hide_menu'] = '';
		$data['hide_sidemenu'] = '';
		$data['content_view'] = 'user/forgot_password';
		$data['title'] = 'webADT | Forgot Password';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}

	public function test_ar() {
		$this -> load -> model('test');
		$result = $this -> test -> get_users();
		echo '<pre>';
		print_r($result);
		echo '</pre>';
	}

	public function test_dql() {
		$this -> load -> model('test');
		$result = $this -> test -> get_users_dql();
		echo '<pre>';
		print_r($result);
		echo '</pre>';
	}

	public function test_obj() {
		$this -> load -> model('test');
		$result = $this -> test -> get_users_obj();
		echo '<pre>';
		print_r($result);
		echo '</pre>';
	}

}
