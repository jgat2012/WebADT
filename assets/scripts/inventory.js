function runDataTable(table_id) {
	
	var oTable = $('#'+table_id+'').dataTable({
		"sDom" : "<'dt-top-row'><'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
		//"sDom" : "t<'row dt-wrapper'<'col-sm-6'i><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'>>",
		"oLanguage" : {
			"sSearch" : "Search all columns:"
		},
		"bServerSide": true,
		"sPaginationType": "full_numbers",
		"bStateSave" : true,
		"bJQueryUI": true,
		"bSortCellsTop" : true,
		"sAjaxSource": "inventory/listing/2",
		"aoColumns": [
        { "sWidth": "30%" },
        { "sWidth": "25%" },
        { "sWidth": "5%", "sClass": "center", "bSortable": false },
        { "sWidth": "10%" },
        { "sWidth": "10%"},
        { "sWidth": "10%" },
        { "sWidth": "10%" },
        { "sWidth": "5%", "sClass": "center", "bSortable": false }],
        "aoColumnDefs": [ { "bSearchable": true, "aTargets": [0,1,4,5] }, { "bSearchable": false, "aTargets": [ "_all" ] } ]
 
	});		
	oTable.columnFilter({ 
         /*	sPlaceHolder: "head:after",*/
         	aoColumns: [{ type: "text"},{ type: "text" },null,null,{ type: "text" },{ type: "text" },null]}
    );

}
