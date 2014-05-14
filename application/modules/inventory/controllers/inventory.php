<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Inventory extends MY_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['content_view'] = 'inventory/listing';
		$data['page_title'] = 'Listing';
		$data['title'] = 'webADT | Inventory';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}
	
}

?>