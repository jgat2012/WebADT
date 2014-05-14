<?php

class M_Store extends My_Model {

	function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$stores = $this -> em -> createQuery('SELECT c FROM models\Entities\CccStoreServicePoint c');
		$stores = $stores -> getArrayResult();
		return $stores;
	}

	public function getActive() {
		$stores = $this -> em -> createQuery('SELECT c FROM models\Entities\CccStoreServicePoint c WHERE c.active=1');
		$stores = $stores -> getArrayResult();
		return $stores;
	}

	public function getStoreType($ccc_id){
		$stores = $this -> em -> createQuery('SELECT c.store FROM models\Entities\CccStoreServicePoint c WHERE c.active=1 AND c.id="'.$ccc_id);
		$stores = $stores -> getArrayResult();
		return $stores[0];
	}

}
