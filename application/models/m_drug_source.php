<?php

class M_Drug_Source extends My_Model {

	function __construct() {
		parent::__construct();
	}

    public function getAll() {
        $sources = $this -> em -> createQuery('SELECT ds FROM models\Entities\DrugSource ds');
        $sources = $sources -> getArrayResult();
        return $sources;
    }

    public function getActive() {
        $sources = $this -> em -> createQuery('SELECT t FROM models\Entities\DrugSource ds WHERE ds.active=1');
        $sources = $sources -> getArrayResult();
        return $sources;
    }


}
