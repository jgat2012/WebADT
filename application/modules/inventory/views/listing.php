
<div class="container-fluid center_content_holder">
	
	<div class="row jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="true">
		<header>
			<span class="widget-icon"> <i class="fa fa-archive"></i> </span>
			<h2>Inventory Summary </h2>
		</header>
		<div class="row">
		<ul class="nav nav-tabs" class="sub_menus">
			<?php
			//Loop through each ccc store/pharmacy and display it;
			foreach($ccc_stores as $ccc_store){
				$name = $ccc_store['name'];
				$pos1 = stripos($name, 'main pharmacy');//Check if Main Pharmacy exists
				$pos2 = stripos($name, 'pharmacy');//If Main Pharmacy doesn't exist, Check if Pharmacy exists
				
				$class_active = '';
				if ($pos1 === false) {//If Main Pharmacy is not among the list, check for Pharmacy
					$class_active = '';
					if ($pos2 === true) {//If Pharmacy exists (Person logged in as a CCC Store)
						$class_active = 'active';
					}else{
						$class_active = '';
					}
				}else{
					$class_active = 'active';
				}
				echo '<li class="'.$class_active.'"><a href="#">'.$name.'</a></li>';
			}
			?>
		</ul>
	</div>
		<div>
			<!-- widget edit box -->
			<div class="jarviswidget-editbox"></div>
			<!-- end widget edit box -->
			
			<div class="widget-body no-padding">
				<div class="widget-body-toolbar">

				</div>
				<div class="row">
					<div class="container-fluid">
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="widget-body no-padding">
								
								<table id="inventory_table" class="table table-striped table-bordered table-hover smart-form">
									<thead>
										<tr>
											<th>Commodity</th><th>Generic Name</th><th>Qty /SOH</th><th>Unit</th><th>Pack Size</th><th>Supplier</th><th>Dose</th><th>Action</th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<tr>
											<th>Commodity</th><th>Generic Name</th><th>Qty /SOH</th><th>Unit</th><th>Pack Size</th><th>Supplier</th><th>Dose</th><th>Action</th>
										</tr>
							       </tfoot>
								</table>
							</div>
						</article>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	
</div>
<!-- DATATABLES JS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/jquery.dataTables-cust.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/ColReorder.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/FixedColumns.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/ColVis.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/ZeroClipboard.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/TableTools.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/DT_bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/plugin/datatables/columnFilter.js"></script>
	<!-- CUSTOMIZED DATATABLES JS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/datatables_customized.js"></script>

<!-- Run customized datables -->
<script src="<?php echo base_url();?>assets/scripts/inventory.js"></script>
<script type="text/javascript">
	runDataTable('inventory_table');
</script>