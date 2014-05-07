<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Migration extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['hide_sidemenu'] = '';
		$data['content_view'] = 'migration/migration';
		$data['title'] = 'webADT | Migration';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}

}
