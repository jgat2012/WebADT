<?php

class M_Cdrr extends My_Model {

	function __construct() {
		parent::__construct();
	}

  public function getDrugConsumption($drug_id,$facility_id,$column){
    $current_month_start = date('Y-m-01');
    $period_start_1 = date('Y-m-d', strtotime($current_month_start . "-1 month"));
    $period_start_2 = date('Y-m-d', strtotime($current_month_start . "-2 months"));
    $period_start_3 = date('Y-m-d', strtotime($current_month_start . "-3 months"));
    $sql = "SELECT SUM(ci.$column) as total_out
            FROM cdrr c 
            LEFT JOIN cdrr_item ci ON ci.cdrr_id=c.id
            LEFT JOIN drugcode dc ON dc.map=ci.drug_id
            WHERE(c.period_begin='$period_start_1' 
              OR c.period_begin='$period_start_2' 
              OR c.period_begin='$period_start_3')
            AND dc.id='$drug_id'
            AND c.facility_id='$facility_id'
            GROUP BY c.period_begin";
    $query = $this -> db -> query($sql);
    $consumption = $query -> result_array();
    return @$consumption[0]['total_out'];
 }


}
