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
				      <select id="facility_code" name="facility_code" class="form-control" >
				        <option value=""> Select Facility </option>
				        <?php 
				          foreach($facilities as $facility){
				        ?>
                           <option value="<?php echo $facility['facility_code'];?>"><?php echo $facility['facility_name']; ?></option>
                        <?php
				          }
				        ?>
				      </select>
				    </div>
				    <div class="form-group" id="fg_ccc_pharmacy">
				      <label for="ccc_pharmacy">Pharmacy</label>
					      <select id="ccc_pharmacy" name="ccc_pharmacy" class="form-control">
					        <option value=""> Select Pharmacy </option>
					        <?php 
					          foreach($stores as $store){
					        ?>
	                           <option value="<?php echo $store['ccc_id'];?>"><?php echo $store['ccc_name']; ?></option>
	                        <?php
					          }
					        ?>
					      </select>
				    </div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
				      <label for="source_database">Database</label>
				      <select id="source_database" name="source_database" class="form-control">
				        <option value=""> Select Database </option>
				        <?php 
				          foreach($databases as $database){
				        ?>
                           <option value="<?php echo $database['Database'];?>"><?php echo $database['Database']; ?></option>
                        <?php
				          }
				        ?>
				      </select>
				    </div>
				    <div class="form-group">
	                    <label for="table" id="lbltable" name="lbltable">Tables</label><br />
						<select class=" form-control multiselect col-md-10" id="table" name="table" multiple="multiple" required="required">
				        <?php 
				          foreach($tables as $table=>$table_config){
				        ?>
                           <option value="<?php echo $table;?>"><?php echo $table; ?></option>
                        <?php
				          }
				        ?>
						</select>
	                </div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="form-group">
					<button type="submit" id="migrate_btn" class="btn btn-primary">Start Migration</button>
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

