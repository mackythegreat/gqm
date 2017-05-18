
<body>

	<p>Welcome: <?php echo $this->session->userdata('eid'); ?>	<?php echo anchor('login/logout','logout'); ?> </p>
			
	CREATE RESOURCE ACCOUNT :<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
					
	<?php echo form_open_multipart('user/add_user'); ?>
					
	Enterprise ID: 					
	<?php echo form_input('eid', set_value('eid')); ?> <?php echo form_error('eid'); ?>
	
	Level:
	<?php $team = array ('12' => 'Associate Software Engineer', '11' => 'Software Engineer', '10' => 'Senior Software Engineer', '9' => 'Team Lead', '8' => 'Associate Manager', '7' => 'Project Manager', '6' => 'Senior Project Manager' ); ?>
	<?php echo form_dropdown('career_level_id',$team); ?> <?php echo form_error('career_level_id'); ?>
	
	Team:
	<?php $team = array ('1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
	<?php echo form_dropdown('team_id',$team); ?> <?php echo form_error('team_id'); ?>

	User Type:
	<?php $type = array ('User' => 'User', 'Lead' => 'Lead'); ?>
	<?php echo form_dropdown('user_type',$type); ?> <?php echo form_error('user_type'); ?>
				
	Tagged as Administrator:
	<?php $is_admin = array ('0' => 'No', '1' => 'Yes'); ?>
	<?php echo form_dropdown('is_admin',$is_admin); ?> <?php echo form_error('is_admin'); ?>
						
	Tagged as Quality Representative:
	<?php $is_qa_rep = array ('0' => 'No', '1' => 'Yes'); ?>
	<?php echo form_dropdown('is_qa_rep',$is_qa_rep); ?> <?php echo form_error('is_qa_rep'); ?>
	
	<?php echo form_submit('submit','Create');?>
						  
	<?php echo form_close(); ?>
					
</body>