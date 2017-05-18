<!-- Modal -->
  <div class="modal fade" id="addProjectModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" ng-app="app" ng-controller="MainCtrl as main">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
		 
          <h4 class="modal-title">Add New Project</h4>
        </div>
        <div class="modal-body">
			
			<?php echo form_open_multipart('project/add_project', 'name="projForm" novalidate'); ?>
					
				<!--Project Name-->
				<div class="form-group" ng-class="{ 'has-error': projForm.proj_name.$touched && projForm.proj_name.$invalid }">
					<label><span class="text-danger"><b>*</b></span> PROJECT NAME</label>
					<?php echo form_input('proj_name', set_value('proj_name'), 'class="form-control form-control-lg" ng-model="main.proj_name"
					ng-minlength="5"
					ng-maxlength="50"
					required'); ?> 
					
					<div class="help-block" ng-messages="projForm.proj_name.$error" ng-if="projForm.proj_name.$touched">
					<p ng-message="minlength">Project Name is too short. Mininum characters of 5.</p>
					<p ng-message="maxlength">Project Name is too long. Maximum characrers of 50.</p>
					<p ng-message="required">Project Name is required.</p>
					
					</div>
				</div>
				
				<!--Team-->
				<?php if (($this->session->userdata('is_admin') == 1) || ($this->session->userdata('is_qa_rep') == 1)) { ?> 
				<div class='show'> <?php } else { ?>  <div class='hidden'> <?php } ?>
					<div class="form-group" ng-class="{ 'has-error': projForm.capability_id.$touched && projForm.capability_id.$invalid }">
						<label><span class="text-danger"><b>*</b></span> Team</label>
						<?php $team = array ('1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
						<?php echo form_dropdown('capability_id',$team, '','class="form-control form-control-lg"'); ?>
					</div>
				</div>
					
				<!-- START DATE -->	
				<div class="form-group" ng-class="{ 'has-error': projForm.start_date.$touched && projForm.start_date.$invalid }">
					<label><span class="text-danger"><b>*</b></span> START DATE </label><br />
					<div id="start_date" class="input-group date"  data-date-format="yyyy-dd-mm">
						<?php echo form_input('start_date', set_value('start_date'), 'type="text" class="form-control"
						ng-model="main.eid"
						required'); ?>
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
					
					<script type="text/javascript">
						$("#start_date").datepicker({
							format: "yyyy-mm-dd",
							autoclose: true,
							todayHighlight: true,
							clearBtn: true
						});
					</script>
				
					<div class="help-block" ng-messages="projForm.start_date.$error" ng-if="projForm.start_date.$touched">
						<p ng-message="required">Start Date is required.</p>
					</div>
				</div>
					
					<label><span class="text-danger"></span> End Date</label><br />
					<div id="end_date" class="input-group date" data-date-format="yyyy-dd-mm">
						<!--input type="text" class="form-control" id="end-date" name="end_date"-->
						<?php echo form_input('end_date', set_value('end_date'), 'type="text" class="form-control"'); ?>
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
					<br />
					
					<?php echo form_error('end_date'); ?> 
					
					<script type="text/javascript">
						$("#end_date").datepicker({
							format: "yyyy-mm-dd",
							autoclose: true,
							todayHighlight: true,
							clearBtn: true
						});
					</script>   
					
					<label><span class="text-danger"><b>*</b></span> Status</label><br />
					<?php $status = array ('Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
					<?php echo form_dropdown('status',$status, '','class="form-control form-control-lg"'); ?> <?php echo form_error('status'); ?>             
					<br /><br />
					
        </div>
        <div class="modal-footer">
			<?php echo form_submit('submit','Save','class="btn btn-info" ng-disabled="projForm.$invalid"');?>
			<?php echo form_close(); ?>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
        </div>
      </div>
	  
      
    </div>
  </div>