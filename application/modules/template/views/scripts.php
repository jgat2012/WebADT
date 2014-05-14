	<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
	<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

	<!-- BOOTSTRAP JS -->		
	<script src="<?php echo base_url();?>assets/scripts/bootstrap/bootstrap.min.js"></script>
	
	<!-- BOOTSTRAP MULTI SELECT JS -->		
	<script src="<?php echo base_url();?>assets/scripts/bootstrap/bootstrap-multiselect.js"></script>

	<!-- CUSTOM NOTIFICATION -->
	<script src="<?php echo base_url();?>assets/scripts/notification/SmartNotification.min.js"></script>

	<!-- JARVIS WIDGETS -->
	<script src="<?php echo base_url();?>assets/scripts/smartwidgets/jarvis.widget.min.js"></script>
	
	<!-- EASY PIE CHARTS -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
	
	<!-- SPARKLINES -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/sparkline/jquery.sparkline.min.js"></script>
	
	<!-- JQUERY VALIDATE -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/jquery-validate/jquery.validate.min.js"></script>
	
	<!-- JQUERY MASKED INPUT -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/masked-input/jquery.maskedinput.min.js"></script>
	
	<!-- JQUERY SELECT2 INPUT -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/select2/select2.min.js"></script>

	<!-- JQUERY UI + Bootstrap Slider -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
	
	<!-- browser msie issue fix -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/msie-fix/jquery.mb.browser.min.js"></script>
	
	<!-- FastClick: For mobile devices -->
	<script src="<?php echo base_url();?>assets/scripts/plugin/fastclick/fastclick.js"></script>
	
	<!-- REPLACEMENT SELECT BOX -->
	<script src="<?php echo base_url();?>assets/scripts/select2-3.4.8/select2.js"></script>
	
	
	<!--[if IE 7]>
		
		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		
	<![endif]-->
	
	<!-- MAIN APP JS FILE -->
	<script src="<?php echo base_url();?>assets/scripts/general.js"></script>
	
	<!-- DATATABLES JS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/jquery.dataTables-cust.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/ColReorder.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/FixedColumns.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/ColVis.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/ZeroClipboard.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/TableTools.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/DT_bootstrap.js"></script>
	
	<!-- CUSTOMIZED DATATABLES JS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/datatables_customized.js"></script>
	

	<script type="text/javascript">
		runAllForms();

		$(function() {
			// Validation
			$("#login-form").validate({
				// Rules for form validation
				rules : {
					email : {
						required : true,
						email : true
					},
					password : {
						required : true,
						minlength : 3,
						maxlength : 20
					}
				},

				// Messages for form validation
				messages : {
					email : {
						required : 'Please enter your email address',
						email : 'Please enter a VALID email address'
					},
					password : {
						required : 'Please enter your password'
					}
				},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
		});
	</script>

	
	<!-- Initialize the multi select plugin: -->
	<script type="text/javascript">
	  $(document).ready(function() {
	    $('.multiselect').multiselect({
	    	includeSelectAllOption : true,
			maxHeight : 300,
			enableFiltering : true,
			filterBehavior : 'both',
			enableCaseInsensitiveFiltering : true,
			filterPlaceholder : 'Search'
		});
		runDataTables();
		
	  });
	</script>