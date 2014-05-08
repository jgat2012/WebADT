$(function() {
	// Validation
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
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});
	
	
	//Migration button clicked
	$( "#fmMigration" ).submit(function( event ) {
	  event.preventDefault();
	});
});

