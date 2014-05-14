<?php

class M_Sync_Facility extends My_Model {

	function __construct() {
		parent::__construct();
	}
  public function getId($facility_code, $status_code = 0) {
    if ($status_code == 0) {
      $conditions = "code='$facility_code' and ordering='1'";
    } else if ($status_code == 3) {
      $conditions = "code='$facility_code' and category like '%standalone%'";
    } else {
      $conditions = "code='$facility_code' and service_point='1'";
    }
    $sql="SELECT id 
          FROM sync_facility 
          WHERE $conditions";
    $query=$this->db->query($sql);
    $sync_facility=$query->result_array();
    return @$sync_facility[0];
  }
}
