<title>Add New Project</title>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 well" style="margin-top:100px;">
				<label><span class="text-danger"></span> ADD PROJECT</label><br />
				<br/>
				
				<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
				
				<?php echo form_open_multipart('project/add_project'); ?>
					
					<label><span class="text-danger"><b>*</b></span> Project Name</label><br />
					<?php echo form_input('proj_name', set_value('proj_name'), 'class="form-control form-control-lg"'); ?> 
					<?php echo form_error('proj_name'); ?>
					<br />
					
					<?php if (($this->session->userdata('is_admin') == 1) || ($this->session->userdata('is_qa_rep') == 1)) { ?> 
					<div class='show'> <?php } else { ?>  <div class='hidden'> <?php } ?>
					
					<label><span class="text-danger"><b>*</b></span> Team</label><br />
					<?php $team = array ('1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
					<?php echo form_dropdown('capability_id',$team, '','class="form-control form-control-lg"'); ?> <?php echo form_error('capability_id'); ?>
					</div>
					<br />
					
					<label><span class="text-danger"><b>*</b></span> Start Date</label><br />
					<div id="start_date" class="input-group date" data-date="2015-01-01" data-date-format="yyyy-dd-mm">
						<!--<input type="text" class="form-control" id="start-date" name="start_date">-->
						<?php echo form_input('start_date', set_value('start_date'), 'type="text" class="form-control"'); ?>
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
					<?php echo form_error('start_date'); ?>
					
					<script type="text/javascript">
						$("#start_date").datepicker({
							format: "yyyy-mm-dd",
							autoclose: true,
							todayHighlight: true,
							clearBtn: true
						});
					</script>
					
					<br />
					
					<label><span class="text-danger"></span> End Date</label><br />
					<div id="end_date" class="input-group date" data-date="2015-01-01" data-date-format="yyyy-dd-mm">
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
					
					<?php echo form_submit('submit','Create', 'class="btn btn-block btn-warning"');?>
						  
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

</body>