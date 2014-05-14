<?php
class Inventory extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		//get all active ccc_stores/pharmacies in the facility
		$data['ccc_stores']=$this->getPharmacies();
		$data['content_view']='inventory/inventory';
		$this->base_params($data);
	}

	public function getPharmacies(){
      //get active ccc_stores/pharmacies in the facility
	  $this->load->model('m_store');
	  $stores = $this -> m_store -> getActive();
	  return $stores;
	}

	public function listing($ccc_id='1'){
		$iDisplayStart = $this -> input -> get_post('iDisplayStart', true);
		$iDisplayLength = $this -> input -> get_post('iDisplayLength', true);
		$iSortCol_0 = $this -> input -> get_post('iSortCol_0', true);
		$iSortingCols = $this -> input -> get_post('iSortingCols', true);
		$sSearch = $this -> input -> get_post('sSearch', true);
		$sEcho = $this -> input -> get_post('sEcho', true);

		//Columns
		$aColumns = array('drug', 'generic_name', 'stock_level', 'drug_unit', 'pack_size', 'supported_by', 'dose');

		//Paging
		$sLimit = "";
		if (isset($iDisplayStart) && $iDisplayLength != '-1') {
			$sLimit = "LIMIT " . intval($iDisplayStart) . ", " . intval($iDisplayLength);
		}

		// Ordering
		$sOrder = "";
		if (isset($_GET['iSortCol_0'])) {
			$sOrder = "ORDER BY  ";
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
					$sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
				}
			}

			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
		}

		//Filtering
		$sFilter = "";
		$c = 0;
		if (isset($sSearch) && !empty($sSearch)) {
			$sFilter = "AND ( ";
			for ($i = 0; $i < count($aColumns); $i++) {
				$bSearchable = $this -> input -> get_post('bSearchable_' . $i, true);

				// Individual column filtering
				if (isset($bSearchable) && $bSearchable == 'true') {
						if ($c != 0) {
							$sFilter .= " OR ";
						}
						$c = 1;
						$sSearch = mysql_real_escape_string($sSearch);
						$sFilter .= "`" . $aColumns[$i] . "` LIKE '%" . $sSearch . "%'";
				}
			}
			$sFilter .= " )";
			if ($sFilter == "AND ( )") {
				$sFilter = "";
			}
		}

		// Data set length after filtering
		$this -> db -> select('COUNT(id) AS found_rows 
			                   FROM drugcode dc 
			                   WHERE dc.enabled=1 
			                   AND dc.ccc_store_sp="'.$ccc_id.'"'. $sFilter);
		$iFilteredTotal = $this -> db -> get() -> row() -> found_rows;

		//Total number of items that are displayed
		$this -> db -> select('COUNT(id) AS found_rows 
			                   FROM drugcode dc 
			                   WHERE dc.enabled=1
			                   AND dc.ccc_store_sp="'.$ccc_id.'"');
		$iTotal = $this -> db -> get() -> row() -> found_rows;

		// Data
		$sql = "SELECT dc.id,
				       UPPER(dc.drug) AS drug,
				       UPPER(g.Name) AS generic_name,
				       IF(SUM(balance)>0,SUM(balance) ,'0') AS stock_level,
				       du.Name AS drug_unit,
				       dc.pack_size,
				       s.name AS supported_by,
				       dc.dose
				FROM drugcode dc
				LEFT JOIN generic_name g ON g.id = dc.generic_name
				LEFT JOIN drug_source s ON s.id = dc.supported_by
				LEFT JOIN dose d ON d.Name = dc.dose
				LEFT JOIN drug_unit du ON du.id = dc.unit
				LEFT JOIN (SELECT * 
						   FROM drug_stock_balance
						   WHERE expiry_date > CURDATE()
						   AND ccc_store_sp =  '$ccc_id') AS dsb ON dsb.drug_id = dc.id
				WHERE dc.enabled =  '1' 
				AND dc.ccc_store_sp='$ccc_id' " . $sFilter . "
				GROUP BY dc.id " . $sOrder . " " . $sLimit;
		$query = $this -> db -> query($sql);
		$rResult = $query;

		// Output
		$output = array('sEcho' => intval($sEcho), 
			            'iTotalRecords' => $iTotal, 
			            'iTotalDisplayRecords' => $iFilteredTotal, 
			            'aaData' => array());

		//loop through data to append options such as 
		foreach ($rResult->result_array() as $aRow) {
			$row = array();
			foreach ($aColumns as $col) {
				//format Stock On Hand i.e bold & green
				if ($col == "stock_level") {
					$row[] = '<b style="color:green">' . number_format($aRow['stock_level']) . '</b>';
				} else {
					$row[] = $aRow[$col];
				}
			}
			//append bin card options to each drug
			$drug_id = $aRow['id'];
			$param=array('class'=>'btn btn-primary');
			$row[]=anchor('inventory/getDrugBinCard/'.$drug_id.'/'.$ccc_id, 'Bin Card', $param);
			$output['aaData'][] = $row;
		}
        return $output;
	}

	public function getDrugBinCard($drug_id='',$ccc_id=''){
		//get drug information
        $this->load->model('m_drug');
        $drug=$this->m_drug->getDrug($drug_id,$ccc_id);
        if($drugs){
        	$data['commodity']=$drug['drug'];
        	$data['unit']=$drug['drugunit'];
        }
        $total_stock=0;
        //get batch information
        $drug_batches=array();
        $batches=$this->m_drug->getDrugBatches($drug_id,$ccc_id);
        if($batches){
        	foreach($batches as $counter=>$batch){
                $drug_batches[$counter]['drugname']=$batch[$counter]['drugname'];
                $drug_batches[$counter]['packsize']=$batch[$counter]['pack_size'];
                $drug_batches[$counter]['batchno']=$batch[$counter]['batch_number'];
                $drug_batches[$counter]['qty']=$batch[$counter]['balance'];
                $drug_batches[$counter]['expirydate']=$batch[$counter]['expiry_date'];
                $total_stock=$total_stock+$batch[$counter]['balance'];
        	}
        }
        $data['total_stock']=$total_stock;
        $data['batches']=$drug_batches;
		$data['content_view']='inventory/bincard';
		$this->base_params($data);
	}


	public function getDrugStockLevels($drug_id='',$ccc_id=''){
       //get ccc_store type if store or pharmacy
	   $this->load->model('m_store');
	   $store = $this -> m_store -> getStoreType($ccc_id);

	   if($store==1){
	   	 //is a store
	   }else {
	   	 //is a pharmacy
	   }
	}
	public function getDrugTransactions($drug_id='',$ccc_id=''){
		$iDisplayStart = $this -> input -> get_post('iDisplayStart', true);
		$iDisplayLength = $this -> input -> get_post('iDisplayLength', true);
		$iSortCol_0 = $this -> input -> get_post('iSortCol_0', false);
		$iSortingCols = $this -> input -> get_post('iSortingCols', true);
		$sSearch = $this -> input -> get_post('sSearch', true);
		$sEcho = $this -> input -> get_post('sEcho', true);

        //columns
        $aColumns = array('Order_Number', 
        	              'Transaction_Date', 
        	              't.name as Transaction_Type', 
        	              'Batch_Number', 
        	              'ds.Source', 
        	              'ds.Destination', 
        	              'Expiry_Date', 
        	              'Pack_Size', 
        	              'Packs', 
        	              'ds.Quantity', 
        	              'ds.Quantity_Out', 
        	              'Balance', 
        	              'Unit_Cost', 
        	              'Amount');

        $count = 0;

		// Paging
		if (isset($iDisplayStart) && $iDisplayLength != '-1') {
			$this -> db -> limit($this -> db -> escape_str($iDisplayLength), $this -> db -> escape_str($iDisplayStart));
		}

		// Ordering
		if (isset($iSortCol_0)) {
			for ($i = 0; $i < intval($iSortingCols); $i++) {
				$iSortCol = $this -> input -> get_post('iSortCol_' . $i, true);
				$bSortable = $this -> input -> get_post('bSortable_' . intval($iSortCol), true);
				$sSortDir = $this -> input -> get_post('sSortDir_' . $i, true);

				if ($bSortable == 'true') {
					$this -> db -> order_by($aColumns[intval($this -> db -> escape_str($iSortCol))], $this -> db -> escape_str($sSortDir));
				}
			}
		}
		//Filtering
		if (isset($sSearch) && !empty($sSearch)) {
			for ($i = 0; $i < count($aColumns); $i++) {
				$bSearchable = $this -> input -> get_post('bSearchable_' . $i, true);

				// Individual column filtering
				if (isset($bSearchable) && $bSearchable == 'true') {
					$this -> db -> or_like($aColumns[$i], $this -> db -> escape_like_str($sSearch));
				}
			}
		}


	}

	public function base_params($data){
		$data['title'] = 'webADT | Inventory';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}

}