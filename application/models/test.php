<?php

class Test extends My_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_users() {
		$users = $this -> db -> get('users');
		$users = $users -> result_array();
		return $users;
	}

	public function get_users_dql() {
		$users = $this -> em -> createQuery('SELECT u FROM models\Entities\Users u');
		$users = $users -> getArrayResult();
		return $users;
	}

	public function get_users_obj() {
		$users = $this -> em -> getRepository('models\Entities\Users') -> findOneBy(array('username' => 'sysadmin'));
		$name = $users -> setName('Rufus');
		$this -> em -> persist($name);
		$this -> em -> flush();
		return $name;
	}

}
