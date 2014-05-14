<?php

class M_Drug_Transaction extends My_Model {

	function __construct() {
		parent::__construct();
	}

    public function getDrugConsumption($drug_id,$ccc_id){
       $sql="";
       $query=$this->db->query($sql);
       $batches=$query->result_array();
       return $batches;
	}


}
