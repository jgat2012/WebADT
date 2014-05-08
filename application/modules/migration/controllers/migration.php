<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Migration extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('encrypt');
	}

	public function index() {
        //get all facilities
        $sql = "SELECT facilitycode as facility_code,name as facility_name FROM facilities";
		$query = $this -> db -> query($sql);
		$data['facilities'] = $query -> result_array();
        //get cc_store_pharmacy
        $sql = "SELECT id as ccc_id,name as ccc_name FROM ccc_store_service_point WHERE active='1'";
		$query = $this -> db -> query($sql);
		$data['stores'] = $query -> result_array();
		//get databases in server
		$sql = "SHOW DATABASES";
		$query = $this -> db -> query($sql);
		$data['databases'] = $query -> result_array();
		//get tables
		$data['tables']=$this->mapping();
		//migration view
		$data['content_view'] = 'migration/migration';

		$this->base_params($data);

	}

	public function mapping($facility_code=null,$ccc_pharmacy=null,$table=null){
		$key = $this -> encrypt -> get_key();
		//migration table mapping
		$tables = array(
			 'Drug Source'=>array(
 	            'source'=>'tblarvstocktransourceordestination',
 	            'source_columns'=>array(
 	            	'sdno',
 	            	'sourceordestination',
 	            	'1',
 	            	$ccc_pharmacy),
 	            'destination'=>'drug_source',
 	            'destination_columns'=>array(
 	            	'id',
 	            	'name',
 	            	'active',
 	            	'ccc_store_sp')
 	            ),
			 'Drug Destination'=>array(
			 	'source'=>'tbldestination',
			 	'source_columns'=>array(
			 		'destination',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'drug_destination',
			 	'destination_columns'=>array(
			 		'name',
			 		'active',
 	            	'ccc_store_sp')
			 	),
			 'Drug Unit'=>array(
			 	'source'=>'tblunit',
			 	'source_columns'=>array(
			 		'Name',
 	            	$ccc_pharmacy),
			 	'destination'=>'drug_unit',
			 	'destination_columns'=>array(
			 		'unit',
 	            	'ccc_store_sp')
			 	),
			 'Drug Generic Name' =>array(
			 	'source'=>'tblGenericName',
			 	'source_columns'=>array(
			 		'genid',
			 		'genericname',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'generic_name',
			 	'destination_columns'=>array(
			 		'id',
			 		'name',
			 		'active',
 	            	'ccc_store_sp')
			 	), 
			 'Drug' => array(
			 	'source'=>'tblARVDrugStockMain',
			 	'source_columns'=>array(
			 		'arvdrugsid',
			 		'packsizes',
			 		'unit',
			 		'genericname',
			 		'saftystock',
			 		'comment',
			 		'supportedby',
			 		'stddose',
			 		'stdduration',
			 		'stdqty',
			 		'IF(tbdrug=0,"F","T")as tbdrug',
			 		'IF(inuse=0,"F","T") as inuse',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'drugcode',
			 	'destination_columns'=>array(
			 		'drug',
			 		'pack_size',
			 		'unit',
			 		'generic_name',
			 		'safety_quantity',
			 		'comment',
			 		'supported_by',
			 		'dose',
			 		'duration',
			 		'quantity',
			 		'tb_drug',
			 		'drug_in_use',
			 		'supplied',
 	            	'ccc_store_sp')
			 	),
			 'Drug Brand'=>array(
			 	'source'=>'tbldrugbrandname',
			 	'source_columns'=>array(
			 		'drug_id',
			 		'brand',
 	            	$ccc_pharmacy),
			 	'destination'=>'brand',
			 	'destination_columns'=>array(
			 		'arvdrugsid',
			 		'brandname',
 	            	'ccc_store_sp')
			 	),
			 'Drug Stock Balance'=>array(
			 	'source'=>'tbldrugstockbatch',
			 	'source_columns'=>array(
			 		'arvdrugsid',
			 		'batchno',
			 		'expirydate',
			 		$ccc_pharmacy,
			 		$facility_code,
			 		'quantity',
			 		'trandate',
 	            	$ccc_pharmacy),
			 	'destination'=>'drug_stock_balance',
			 	'destination_columns'=>array(
			 		'drug_id',
			 		'batch_number',
			 		'expiry_date',
			 		'stock_type',
			 		'facility_code',
			 		'balance',
			 		'last_update',
 	            	'ccc_store_sp')
			 	),
			 'Dose' =>array(
			 	'source'=>'tblDose',
			 	'source_columns'=>array(
			 		'dose',
			 		'value',
			 		'frequency',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'dose',
			 	'destination_columns'=>array(
			 	    'Name',
			 		'value',
			 		'frequency',
			 		'Active',
 	            	'ccc_store_sp')
			 	),
			 'Indication' =>array(
			 	'source'=>'tblIndication',
			 	'source_columns'=>array(
			 		'indicationname',
			 		'indicationcode',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'opportunistic_infection',
			 	'destination_columns'=>array(
			 		'name',
			 		'indication',
			 		'active',
 	            	'ccc_store_sp')
			 	),
			 'Regimen Change Reason' => array(
			 	'source'=>'tblReasonforChange',
			 	'source_columns'=>array(
			 		'reasonforchangeid',
			 		'reasonforchange',
			 		'1'),
			 	'destination'=>'opportunistic_infection',
			 	'destination_columns'=>array(
			 		'id',
			 		'name',
			 		'active')
			 	), 
			 'Regimen Category' => array(
			 	'source'=>'tblRegimenCategory',
			 	'source_columns'=>array(
			 		'categoryid',
			 		'categoryname',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'regimen_category',
			 	'destination_columns'=>array(
			 		'id',
			 		'Name',
			 		'Active',
 	            	'ccc_store_sp')
			 	), 
			 'Regimen Service Type' => array(
			 	'source'=>'tblTypeOfService',
			 	'source_columns'=>array(
			 		'typeofserviceid',
			 		'typeofservice',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'regimen_service_type',
			    'destination_columns'=>array(
			 		'id',
			 		'name',
			 		'active',
 	            	'ccc_store_sp')
			    ), 
			 'Regimen' => array(
			 	'source'=>'tblRegimen',
			 	'source_columns'=>array(
			 		'regimencode',
			 		'regimen',
			 		'line',
			 		'remarks',
			 		'category',
			 		'typeoservice',
			 		'IF(`show`=0,"0"',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'regimen',
			 	'destination_columns'=>array(
			 		'regimen_code',
			 		'regimen_desc',
			 		'line',
			 		'remarks',
			 		'category',
			 		'type_of_service',
			 		'enabled',
 	            	'ccc_store_sp')
			 	), 
			 'Regimen Drugs' => array(
			 	'source'=>'tblDrugsInRegimen',
			 	'source_columns'=>array(
			 		'regimencode',
			 		'combinations',
			 		'1'),
			 	'destination'=>'regimen_drug',
			 	'destination_columns'=>array(
			 		'regimen',
			 		'drugcode',
			 		'active')
			 	), 
			 'Patient Status' => array(
			 	'source'=>'tblCurrentStatus',
			 	'source_columns'=>array(
			 		'currentstatusid',
			 		'currentstatus',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'patient_status',
			 	'destination_columns'=>array(
			 		'id',
			 		'Name',
			 		'Active',
 	            	'ccc_store_sp')
			 	), 
			 'Patient Source' => array(
			 	'source'=>'tblSourceOfClient',
			 	'source_columns'=>array(
			 		'sourceid',
			 		'sourceofclient',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'patient_source',
			 	'destination_columns'=>array(
			 		'id',
			 		'name',
			 		'active',
 	            	'ccc_store_sp')
			 	), 
			 'Patient' => array(
			 	'source'=>'tblARTPatientMasterInformation',
			 	'source_columns'=>array(
			 		'artid',
			 		'firstname',
			 		'surname',
			 		'IF(UCASE(sex)="MALE","1","2")',
			 		'IF(pregnant=0,"0","1")',
			 		'STR_TO_DATE(datetherapystarted, "%Y-%m-%d")',
			 		'weightonstart',
			 		'clientsupportedby',
			 		'otherdeaseconditions',
			 		'adrorsideeffects',
			 		'otherdrugs',
			 		'typeofservice',
			 		'STR_TO_DATE(dateofnextappointment, "%Y-%m-%d")',
			 		'currentstatus',
			 		'currentregimen',
			 		'regimenstarted',
			 		'address',
			 		'currentweight', 
			 		'startbsa',
			 		'currentbsa',
			 		'startheight',
			 		'currentheight',
			 		'sourceofclient',
			 		'IF(tb=0,"0","1")',
			 		'STR_TO_DATE(datestartedonart, "%Y-%m-%d")',
			 		'STR_TO_DATE(datechangedstatus, "%Y-%m-%d")',
			 		'lastname',
			 		'IF( dateofbirth IS NULL, IF( age IS NULL , DATE_SUB( datetherapystarted, INTERVAL ncurrentage YEAR ) , DATE_SUB( datetherapystarted, INTERVAL age YEAR ) ) ,STR_TO_DATE( dateofbirth, "%Y-%m-%d"))',
			 		'placeofbirth', 
			 		'patientcellphone',
			 		'alternatecontact',
			 		'IF(patientsmoke=0,"0","1")',
			 		'IF(patientdrinkalcohol=0,"0","1")',
			 		'transferfrom',
			 		$facility_code,
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'patient',
			 	'destination_columns'=>array(
			 		'patient_number_ccc',
			 		'first_name',
			 		'last_name',
			 		'gender',
			 		'pregnant',
			 		'date_enrolled',
			 		'start_weight',
			 		'supported_by',
			 		'other_illnesses',
			 		'adr',
			 		'other_drugs',
			 		'service',
			 		'nextappointment',
			 		'current_status',
			 		'current_regimen',
			 		'start_regimen',
			 		'physical',
			 		'weight',
			 		'start_bsa',
			 		'sa',
			 		'start_height',
			 		'height',
			 		'source',
			 		'tb',
			 		'start_regimen_date',
			 		'status_change_date',
			 		'other_name',
			 		'dob',
			 		'pob',
			 		'phone',
			 		'alternate',
			 		'smoke',
			 		'alcohol',
			 		'transfer_from',
			 		'facility_code',
			 		'drug_prophylaxis',
 	            	'ccc_store_sp')
			 	), 
			 'Patient Appointment' => array(
			 	'source'=>'tblARTPatientMasterInformation',
			 	'source_columns'=>array(
			 		'artid',
			 		'STR_TO_DATE(dateofnextappointment,"%Y-%m-%d")',
			 		$facility_code),
			 	'destination'=>'patient_appointment',
			 	'destination_columns'=>array(
			 		'patient',
			 		'appointment',
			 		'facility')
			 	), 
			 'Transaction Type' => array(
			 	'source'=>'tblStockTransactionType',
			 	'source_columns'=>array(
			 		'transactiontype',
			 		'transactiondescription',
			 		'reporttitle',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'transaction_type',
			 	'destination_columns'=>array(
			 		'id',
			 		'name',
			 		'`desc`',
			 		'active',
 	            	'ccc_store_sp')
			 	), 
			 'Visit Purpose' => array(
			 	'source'=>'tblVisitTransaction',
			 	'source_columns'=>array(
			 		'transactiontype',
			 		'transactiondescription',
			 		'reporttitle',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'visit_purpose',
			 	'destination_columns'=>array(
			 		'id',
			 		'name',
			 		'active',
 	            	'ccc_store_sp')
			 	), 
			 'Users' => array(
			 	'source'=>'tblSecurity',
			 	'source_columns'=>array(
			 		'name',
			 		'userid',
			 		'md5(concat('.$key.',password))',
			 		'IF(UCASE(authoritylevel)="USER","2","3")',
			 		$facility_code,
			 		'1',
			 		'1',
			 		date('Y-m-d H:i:s'),
 	            	$ccc_pharmacy),
			 	'destination'=>'users',
			 	'destination_columns'=>array(
			 		'Name',
			 		'Username',
			 		'Password',
			 		'Access_Level',
			 		'Facility_Code',
			 		'Active',
			 		'Created_By',
			 		'Time_Created',
 	            	'ccc_store_sp')
			 	), 
			 'Drug Transactions' => array(
			 	'source'=>'tblARVDrugStockTransactions',
			 	'source_columns'=>array(
			 		'arvdrugsid',
			 		'STR_TO_DATE(trandate, "%Y-%m-%d")',
			 		'reforderno',
			 		'batchno',
			 		'transactiontype',
			 		$facility_code,
			 		$facility_code,
			 		'STR_TO_DATE(expirydate, "%Y-%m-%d")',
			 		'npacks',
			 		'unitcost',
			 		'IF(t.effect="0",qty,"0")',
			 		'IF(t.effect="1",qty,"0")',
			 		'amount',
			 		'remarks',
			 		'operator',
			 		$facility_code,
 	            	$ccc_pharmacy),
			 	'destination'=>'drug_stock_movement',
			 	'destination_columns'=>array(
			 		'drug',
			 		'transaction_date',
			 		'order_number',
			 		'batch_number',
			 		'transaction_type',
			 		'source','destination',
			 		'expiry_date',
			 		'packs',
			 		'unit_cost',
			 		'quantity',
			 		'quantity_out',
			 		'amount',
			 		'remarks',
			 		'operator',
			 		'facility',
 	            	'ccc_store_sp')
			 	),
			 'Patient Transactions' => array(
			 	'source'=>'tblARTPatientTransactions',
			 	'source_columns'=>array(
			 		'artid',
			 		'STR_TO_DATE(tp.dateofvisit, "%Y-%m-%d")',
			 		'drugname',
			 		'brandname',
			 		'transactioncode',
			 		'arvqty',
			 		'dose',
			 		'duration',
			 	    'regimen',
			 		'lastregimen',
			 		'comment',
			 		'operator',
			 		'indication',
			 		'weight',
			 		'pillcount',
			 		'pillcount',
			 		'adherence',
			 		'reasonsforchange',
			 		'batchno',
			 		$facility_code),
			 	'destination'=>'patient_visit',
			 	'destination_columns'=>array(
			 		'patient_id',
			 		'dispensing_date',
			 		'drug_id',
			 		'brand',
			 		'visit_purpose',
			 		'quantity',
			 		'dose',
			 		'duration',
			 		'regimen',
			 		'last_regimen',
			 		'comment',
			 		'user',
			 		'indication',
			 		'current_weight',
			 		'pill_count',
			 		'months_of_stock',
			 		'adherence',
			 		'regimen_change_reason',
			 		'batch_number',
			 		'facility')
			 	)
			 );
            //if table is not null get value of array in position of the table
			if($table!=null){
			     $tables=$tables[$table];
			}
			return $tables;
	}

	public function migrate(){
		//get posted data
		$facility_code=$this->input->post('facility_code',TRUE);
		$ccc_pharmacy=$this->input->post('ccc_pharmacy',TRUE);
		$source_database=$this->input->post('source_database',TRUE);
		$table=$this->input->post('table',TRUE);

		//retrieve table data from tables array
		$config=$this->mapping($facility_code,$ccc_pharmacy,$table);
		$source_table=$config['source'];
		$source_columns=implode(",", $config['source_columns']);
		$destination_table=$config['destination'];
		$destination_columns=implode(",", $config['destination_columns']);

		//check migration log for last value migrated
		$sql = "SELECT id,last_index,count FROM migration_log WHERE source='$destination_table'";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$offset=0;
		$count=0;
		$migration_id=null;
		if($results){
		  $offset = $results[0]['last_index'];
		  $count = $results[0]['last_index'];
		  $migration_id=$results[0]['id'];
	    }

		//generate sql and execute
		$sql="INSERT IGNORE INTO ".$destination_table."(".$destination_columns.")";
		$sql.="SELECT ".$source_columns; 
		$sql.=" FROM ".$source_database.".".$source_table." LIMIT ".$offset.",18446744073709551615";

		//update migration log
		if($migration_id !=null){
			//count records in source table
			$sql = "SELECT COUNT(*) as total FROM $source_database.$source_table";
		    $query = $this -> db -> query($sql);
		    $results = $query -> result_array();
		    if($results){
		      $last_index =$results[0]['total'];
		    }
			$this -> db -> where('id', $migration_id);
		    $this -> db -> update('migration_log', array('last_index' => $last_index,'count'=>$count));
		}

		//response
		$response="source(".$source_table.") to destination(".$destination_table.") successful";

		echo $response;

	}
	
	public function checkDB($dbname) {//Check if database selected can be migrated
		$sql = "show tables from $dbname like '%tblarvdrugstockmain%';";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		if ($results) {//If database can be migrated
			$temp = 1;
		} else {
			$temp = 0;
		}
		echo $temp;
	}

	public function base_params($data){
		$data['hide_sidemenu']='';
		$data['title'] = 'webADT | Migration';
		$this -> load -> module('template');
		$this -> template -> default_load($data);
	}

}
