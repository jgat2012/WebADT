<?php

class M_Facility extends My_Model {

	function __construct() {
		parent::__construct();
	}

  public function getType($facility_code) {
    $sql="SELECT COUNT(*) as total
          FROM facilities
          WHERE parent = '$facility_code'";
    $query=$this->db->query($sql);
    $consumption=$query->result_array();
    return $facility[0]['total'];
  }


}
