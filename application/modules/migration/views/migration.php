<div class="container-fluid">
	
  <div class="row col-md-8 col-md-offset-2">
  	<form action="migrate/migrate" method="post">
	  	<div class="panel panel-primary">
	  		<div class="panel-heading">
				<span class="panel-title"><i class="panel-title-icon fa fa-tag"></i> Migration Settings</span>
			</div>
			<div class="panel-body tab-content-padding">
				<div class="col-md-5">
					<div class="form-group">
				      <label for="facility_code">Facility</label>
				      <select id="facility_code" name="facility_code" class="form-control">
				        <option value="0">-- Select Facility --</option>
				      </select>
				    </div>
				    <div class="form-group">
				      <label for="ccc_pharmacy">Pharmacy</label>
				      <div class="row">
					      <div class="col-md-5">
						      <select id="ccc_pharmacy" name="ccc_pharmacy" class="form-control">
						        <option value="0">-- Select Pharmacy --</option>
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
				        <option value="0">-- Select Database --</option>
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
  </div>
	
  <div id="migration_body" class="row col-md-8 col-md-offset-2">
		<div class="panel panel-success widget-support-tickets" >
			<div class="panel-heading">
				<span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Support Tickets</span>
			</div> <!-- / .panel-heading -->
			<div class="panel-body tab-content-padding">
				<!-- Panel padding, without vertical padding -->
				<div class="" style="position: relative; overflow: hidden; width: auto; height: 300px;"><div class="panel-padding no-padding-vr" style="overflow: hidden; width: auto; height: 300px;">

					<div class="ticket">
						<span class="label label-warning ticket-label">Pending</span>
						<a href="#" title="" class="ticket-title">Mobile App Problem<span>[#201797]</span></a>
						<span class="ticket-info">
							Opened by <a href="#">Denise Steiner</a> 2 days ago
						</span>
					</div> <!-- / .ticket -->

					<div class="ticket">
						<span class="label label-info ticket-label">In progress</span>
						<a href="#" title="" class="ticket-title">
							<i class="fa fa-warning text-danger"></i>PayPal issue<span>[#201796]</span>
						</a>
						<span class="ticket-info">
							Opened by <a href="#">Robert Jang</a> 3 days ago
						</span>
					</div> <!-- / .ticket -->

					<div class="ticket">
						<span class="label label-danger ticket-label">Rejected</span>
						<a href="#" title="" class="ticket-title">IE8 problem<span>[#201795]</span></a>
						<span class="ticket-info">
							Opened by <a href="#">Robert Jang</a> 4 days ago
						</span>
					</div> <!-- / .ticket -->

					<div class="ticket">
						<span class="label label-success ticket-label">Completed</span>
						<a href="#" title="" class="ticket-title">Server unavaible<span>[#201794]</span></a>
						<span class="ticket-info">
							Opened by <a href="#">Timothy Owens</a> 5 days ago
						</span>
					</div> <!-- / .ticket -->
				</div></div>
			</div> <!-- / .panel-body -->
		</div> <!-- / .panel -->
  </div>
</div>

