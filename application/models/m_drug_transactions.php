<?php

class M_Drug_Transactions extends My_Model {

	function __construct() {
		parent::__construct();
	}

    public function getDrugConsumption($drug_id,$ccc_id){
       $sql="SELECT SUM(dsm.quantity_out) as total_out
             FROM drug_stock_movement dsm
             WHERE dsm.drug='$drug_id' 
             AND DATEDIFF(CURDATE(),dsm.transaction_date) <= 90
             AND dsm.ccc_store_sp='$ccc_id'";
       $query=$this->db->query($sql);
       $consumption=$query->result_array();
       return @$consumption[0]['total_out'];
	}


}
