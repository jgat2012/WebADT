<?php

class M_Transaction_Types extends My_Model {

	function __construct() {
		parent::__construct();
	}

    public function getAll() {
        $transactions = $this -> em -> createQuery('SELECT t FROM models\Entities\TransactionType t');
        $transactions = $transactions -> getArrayResult();
        return $transactions;
    }

    public function getActive() {
        $transactions = $this -> em -> createQuery('SELECT t FROM models\Entities\TransactionType t WHERE t.active=1');
        $transactions = $transactions -> getArrayResult();
        return $transactions;
    }


}
