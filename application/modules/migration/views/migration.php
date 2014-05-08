<div class="container-fluid">
	
  <div class="row col-md-8 col-md-offset-2">
  	<form id="fmMigration" action="migrate/migrate" method="post">
	  	<div class="panel panel-success">
	  		<div class="panel-heading">
				<span class="panel-title"><i class="panel-title-icon fa fa-tag"></i> Migration Settings</span>
			</div>
			<div class="panel-body tab-content-padding">
				<div class="col-md-5">
					<div class="form-group">
				      <label for="facility_code">Facility</label>
				      <select id="facility_code" name="facility_code" class="form-control">
				        <option value=""> Select Facility </option>
				        <option value="1">Machakos</option>
				      </select>
				    </div>
				    <div class="form-group">
				      <label for="ccc_pharmacy">Pharmacy</label>
				      <div class="row">
					      <div class="col-md-5">
						      <select id="ccc_pharmacy" name="ccc_pharmacy" class="form-control">
						        <option value="">-- Select Pharmacy --</option>
						      </select>
						  </div>
						  <div class="col-md-1">
						      <label class=""><b>or</b></label>
						  </div>
						  <div class="col-md-6">
						  	<input type="text" class="form-control" id="new_ccc_store" name="new_ccc_store" placeholder="Enter CCC Store">
						  </div>
					  </div>
				    </div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
				      <label for="source_database">Database</label>
				      <select id="source_database" name="source_database" class="form-control">
				        <option value=""> Select Database </option>
				        <option value="1"> Database </option>
				      </select>
				    </div>
				    <div class="form-group">
	                    <label for="table">Tables</label><br />
						<select class=" form-control multiselect col-md-10" id="table" name="table" multiple="multiple" style=''>
						  <option value="cheese">Cheese</option>	
						  <option value="tomatoes">Tomatoes</option>
						  <option value="mozarella">Mozzarella</option>
						  <option value="mushrooms">Mushrooms</option>
						  <option value="pepperoni">Pepperoni</option>
						  <option value="onions">Onions</option>
						</select>
	                </div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Start Migration</button>
				</div>
			</div>
	  	</div>
	  </form>
  		
  	</div>
	
  <div id="migration_body" class="row col-md-8 col-md-offset-2">
		<div class="panel panel-success widget-support-tickets" >
			<div class="panel-heading">
				<span class="panel-title"><i class="panel-title-icon fa fa-tag"></i> Migration Progress</span>
			</div> <!-- / .panel-heading -->
			<div class="panel-body tab-content-padding">
				<!-- Panel padding, without vertical padding -->
				<div class="" style="position: relative; overflow: hidden; width: auto; height: 300px;">
					<div class="panel-padding no-padding-vr" style="overflow: hidden; width: auto; height: 300px;">
						<label>Overall Progress</label>
						<div class="progress">
						  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						    60%
						  </div>
						</div>
						<hr size="2">
						<div class="ticket">
							<span class="label label-success ticket-label">Completed</span>
							<a href="#" title="" class="ticket-title">
								TableName
							</a>
						</div> <!-- / .ticket -->
					</div>
				</div>
			</div> <!-- / .panel-body -->
		</div> <!-- / .panel -->
  </div>
</div>

