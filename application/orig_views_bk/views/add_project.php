
<body>

	<p>Welcome: <?php echo $this->session->userdata('eid'); ?>	<?php echo anchor('login/logout','logout'); ?> </p>
			
	ADD NEW PROJECT :<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
					
	<?php echo form_open_multipart('project/add_project'); ?>
					
	Project Name: 					
	<?php echo form_input('proj_name', set_value('proj_name')); ?> <?php echo form_error('proj_name'); ?>

	
	<?php if (($this->session->userdata('is_admin') == 1) || ($this->session->userdata('is_qa_rep') == 1)) { ?> 
	<div class='show'> <?php } else { ?>  <div class='hidden'> <?php } ?>
	Team:
	<?php $team = array ('1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
	<?php echo form_dropdown('capability_id',$team); ?> <?php echo form_error('capability_id'); ?>
	</div>
	
Start Date:
<div class="input-group date" data-date="2015-01-01" data-date-format="yyyy-dd-mm">
    <!--<input type="text" class="form-control" id="start-date" name="start_date">-->
	<?php echo form_input('start_date', set_value('start_date'), 'type="text" class="form-control" id="start_date"'); ?>
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

End Date:
<div class="input-group date" data-date="2015-01-01" data-date-format="yyyy-dd-mm" id="end_date">
    <!--input type="text" class="form-control" id="end-date" name="end_date"-->
	<?php echo form_input('end_date', set_value('end_date'), 'type="text" class="form-control" '); ?>
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th" ></span>
    </div>
</div>

<?php echo form_error('end_date'); ?> 

<script type="text/javascript">
    $("#end_date").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
		clearBtn: true
    });
</script>   
  
Status:
	<?php $status = array ('Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
	<?php echo form_dropdown('status',$status); ?> <?php echo form_error('status'); ?>             

	<?php echo form_submit('submit','Create');?>
						  
	<?php echo form_close(); ?>
					
</body>