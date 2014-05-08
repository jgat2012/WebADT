$(function() {
	
	
	
	
	// Validate the migration form
	$("#fmMigration").validate({
		// Rules for form validation
		rules : {
			facility_code : {
				required : true
			},
			source_database : {
				required : true
			},
			table : {
				required : true
			}
		},

		// Messages for form validation
		messages : {
			facility_code : {
				required : 'Please select a facility'
			},
			source_database : {
				required : 'Please select a database'
			},
			table : {
				required : 'You have not selected any table'
			},
			ignore: ':hidden:not("#table")'
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});
	
	
	//function when database is selected,gets the target tables if match is correct
	$("#source_database").on('change', function() {
		//Remove incorrect database message from dom
		$("#incorrect_database").remove();
		
		$("#migrate_btn").attr('disabled', 'disabled');
		var database_name = $(this).val();
		var link = 'migration/checkDB/' + database_name;
		$.ajax({
			url : link,
			type : 'POST',
			dataType : "json",
			success : function(data) {
				
				//append target tables
				$("#target_tables").multiselect('dataprovider', data);
				if(data != 0) {
					$("#migrate_btn:disabled").removeAttr('disabled');
					//toastr.success('Database successfully selected!', 'Migration', opts);
				} else {
					console.log(data);
					//display error wrong database chosen
					$("<em class='invalid' id='incorrect_database'>Database selected cannot be migrated !</em>").insertAfter("#source_database");
				}
			}
		});
	});
	
	
	//Select table dropdown change
	$("#table").on('change', function() {
		$( ".no_table_selected" ).remove();//Remobe error message for table not selected from dom
		var check = checkTableSelected();
		if(check == 0){
			$("<em class='invalid' id='no_table_selected'>Please select at least one table to migrate !</em>").insertAfter(".btn-group");
		}
	});
	
	
	//When Start Migration button clicked
	$( "#fmMigration" ).submit(function( event ) {
	 $( "#no_table_selected" ).remove();//Remobe error message for table not selected from dom
	 $( "#no_ccc_pharmacy" ).remove();//Remobe error message for table not selected from dom
	  event.preventDefault();
	  var selectedTables = checkTableSelected();
	  if(selectedTables!=0){//If table validation works, meaning at least one tabe, submit data
	  	var btn = $("#migration_btn");
	    btn.button('Migrating ...');
	    
	    var check_ccc_pharmacy = selectedCccPharmacy();//Check if ccc pharmacy was entered or selected
	    
	    if(check_ccc_pharmacy==''){//If no CCC pharmacy, append error message
	    	$("<em class='invalid' id='no_ccc_pharmacy'>Please select or enter a CCC Pharmacy !</em>").insertAfter("#fg_ccc_pharmacy");
	    	return;
	    }
	    
	    
		var facility_code = $("#facility_code").val();
		var selected_ccc_pharmacy = check_ccc_pharmacy;
		var database_name = $("#source_database").val();
		
		
		//If everything is ok, start migration
		startMigration(facility_code,selected_ccc_pharmacy,database_name,selectedTables);
	    
		
	  }
	  else{
	  	$("<em class='invalid' id='no_table_selected'>Please select at least one table to migrate !</em>").insertAfter(".btn-group");
	  }
	  
	});
	
});


function checkTableSelected(){//Function to check if database tables to be migrated were selected
	//Variable to check if all database tables are selected, true if all are selected, false if not
	  var allSelected = $("#fmMigration #table option:not(:selected)").length == 0;
	  var check = 0;
	  var selectedTables = $('#table').val();
	  if(allSelected){//If all database tables are selected
	  	check = selectedTables;
	  }else{
	  	
	  	 
	  	if(selectedTables==null){//If no table was selected
	  		check = 0;
	  	}else{//Is some tables were selected
	  		check = selectedTables;
	  	}
	  }
	  
	  return check;
}

function selectedCccPharmacy(){// Function to get the selected pharmacy or the entered value from the migration settings form
	var selectedPharmacy = $.trim($('#ccc_pharmacy').val());
	if(selectedPharmacy==null){//No pharmacy selected
		selectedPharmacy = $('#new_ccc_store').val();
	}
	return selectedPharmacy;
}

//function to start migration
function startMigration(facility_code,ccc_pharmacy,database,selected_tables) {
	//get overall total table selected
	var overall_total = selected_tables.length;
	
	var table_counter = 0;
	var overall_percentage = 0;
	//check if multi-select lable is present and remove it from the count
	if($.inArray("multiselect-all", selected_tables) > -1) {
		overall_total = overall_total - 1;
	}
	//exclude select all
	$.each(selected_tables, function(i, v) {
		var source_table = v;
		if(source_table != "multiselect-all") {
			table_counter++;
			//Check Migration Log
			checkLog(source_table, table_counter, overall_total,facility_code,ccc_pharmacy,database);
			return;
		}
	});
}

//function to check migration last index and count records in target table
function checkLog(source_table, table_counter, overall_total, facility_code,ccc_pharmacy,database) {
	
	var link = 'migration/getLog';
	$.ajax({
		url : link,
		type : 'POST',
		dataType : "json",
		data : {
			"database_name" : database,
			"source_table" : source_table
		},
		success : function(data) {
			//get data from the log and run migration
			var details = [];
			details.push({
				source : source_table,
				target : data.target,
				count : data.count,
				offset : data.last_index,
				database : database,
				total_records : data.total_records,
				table_count : table_counter,
				table_total : overall_total
			});
			Migrate(details);
		}
	});
}