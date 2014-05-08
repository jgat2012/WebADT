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
			ccc_pharmacy : {
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
			ccc_pharmacy : {
				required : 'You have not selected any Store'
			}
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
		
	//Reset progress bar
	$("#migration_overall_progress").text('0%');
	$("#migration_overall_progress").attr("aria-valuenow",'0');
	$("#migration_overall_progress").css("width",'0%');		

		
	 $( "#no_table_selected" ).remove();//Remobe error message for table not selected from dom
	 $( "#no_ccc_pharmacy" ).remove();//Remobe error message for table not selected from dom
	  event.preventDefault();
	  var selectedTables = checkTableSelected();
	  if(selectedTables!=0){//If table validation works, meaning at least one tabe, submit data
	  	var btn = $("#migration_btn");
	    btn.button('Migrating ...');
	    
	    var selectedPharmacy = $.trim($('#ccc_pharmacy').val());//Check if ccc pharmacy was entered or selected
	    
	    var facility_code = $("#facility_code").val();
		var selected_ccc_pharmacy = selectedPharmacy;
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
	getCurrentTable(table_counter,selected_tables,overall_total,facility_code,ccc_pharmacy,database);
}


//Function to check current table being migrated and its index
function getCurrentTable(table_counter,selected_tables,overall_total,facility_code,ccc_pharmacy,database){
	var index = table_counter;
	var current_table = selected_tables[index];
	if(current_table == "multiselect-all") { //If select all option is selected, increment the index
		table_counter++;
		getCurrentTable(table_counter,selected_tables,overall_total,facility_code,ccc_pharmacy,database);
		return;
		
	}else{
		//Check Migration Log
		migrate(current_table, table_counter, overall_total,facility_code,ccc_pharmacy,database,selected_tables);
		//return;
	}
}

//function to start migration
function migrate(source_table, table_counter, overall_total, facility_code,ccc_pharmacy,database,selected_tables) {
	if(table_counter==0){
		migrated_table = 1;
	}
	var over_progress = (migrated_table/overall_total) *100; //Overall percentage
	over_progress = Math.round(over_progress);
	var link = 'migration/migrate';
	$.ajax({
		url : link,
		type : 'POST',
		dataType : "json",
		data : {
			"facility_code" : facility_code,
			"ccc_pharmacy" : ccc_pharmacy,
			"source_database" : database,
			"table" : source_table
		},
		success : function(data) {
			console.log(overall_total);
			var count = data.count; //Total number of migrated data
			var total = data.total; //Total data to be migrated
			var message = data.message; 
			var source_table = data.source_table; 
			width_overall = over_progress+"%";
			//Update progress bar
			$("#migration_overall_progress").text(width_overall);
			$("#migration_overall_progress").attr("aria-valuenow",over_progress);
			$("#migration_overall_progress").css("width",width_overall);
			$("#migrate_table_result_holder").append(
				'<div class="ticket">'+
					'<span class="label label-success ticket-label">Completed</span>'+
					'<a href="#" title="" class="ticket-title">'+source_table+'</a>'+
				'</div>'
			)
			//If count is not equal to total, run migration for same table
			if(count!=total){
				getCurrentTable(table_counter,selected_tables,overall_total,facility_code,ccc_pharmacy,database);
			}
			else{
				//Check if all the tables have been migrated
				if(migrated_table==overall_total){
					
					return;
				}
				else{//If all the tables have not yet been migrated, continue looping
					table_counter++;
					migrated_table++;
					getCurrentTable(table_counter,selected_tables,overall_total,facility_code,ccc_pharmacy,database);
				}
				
				
			}
			
			
			
			
			
			
		}
	});
}

