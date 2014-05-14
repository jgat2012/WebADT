<?php

class M_Drug extends My_Model {

	function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$stores = $this -> em -> createQuery('SELECT d FROM models\Entities\Drugcode d');
		$stores = $stores -> getArrayResult();
		return $stores;
	}

	public function getActive() {
		$stores = $this -> em -> createQuery('SELECT d FROM models\Entities\Drugcode d WHERE d.enabled=1');
		$stores = $stores -> getArrayResult();
		return $stores;
	}

	public function getDrug($drug_id,$ccc_id){
       $sql="SELECT dc.*,du.Name as drugunit
             FROM drugcode dc
             LEFT JOIN drug_unit du ON du.id=dc.unit
             WHERE dc.id='$drug_id'
             AND dc.ccc_store_sp='$ccc_id'
             AND du.ccc_store_sp='$ccc_id'";
       $query=$this->db->query($sql);
       $drugs=$query->result_array();
       return $drugs[0];
	}

    public function getDrugBatches($drug_id,$ccc_id){
       $sql="SELECT dsb.*,dc.drug,dc.pack_size
             FROM drug_stock_balance dsb 
             LEFT JOIN drugcode dc ON dsb.drug_id=dc.id
             WHERE dsb.drug_id='$drug_id'
             AND dc.ccc_store_sp='$ccc_id'
             AND dsb.ccc_store_sp='$ccc_id'
             AND dsb.expiry_date>CURDATE()
             AND dsb.balance>0";
       $query=$this->db->query($sql);
       $batches=$query->result_array();
       return $batches;
	}


}
