<?php

class M_Drug_Destination extends My_Model {

	function __construct() {
		parent::__construct();
	}

    public function getAll() {
        $destinations = $this -> em -> createQuery('SELECT dd FROM models\Entities\DrugDestination dd');
        $destinations = $destinations -> getArrayResult();
        return $destinations;
    }

    public function getActive() {
        $destinations = $this -> em -> createQuery('SELECT dd FROM models\Entities\DrugDestination dd WHERE dd.active=1');
        $destinations = $destinations -> getArrayResult();
        return $destinations;
    }


}
