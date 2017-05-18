<title>Update User Account</title>
<body>
			
	Welcome: <?php echo $this->session->userdata('eid'); ?>	<?php echo anchor('login/logout','logout'); ?>

	<?php foreach($users_detail as $users_item):?>
	<?php echo form_open_multipart('user/update_user/'.$users_item->eid); ?>
	
	<?php echo form_hidden('id',$users_item->id);?>
					
	Enterprise ID:
	<?php echo form_input('eid',$users_item->eid); ?>
	<?php echo form_error('eid'); ?>
	
	Level:
	<?php $career_select = $users_item->career_level_id; ?>
	<?php $career = array ('12' => 'Associate Software Engineer', '11' => 'Software Engineer', '10' => 'Senior Software Engineer', '9' => 'Team Lead', '8' => 'Associate Manager', '7' => 'Project Manager', '6' => 'Senior Project Manager' ); ?>
	<?php echo form_dropdown('career_level_id',$career, $career_select); ?> <?php echo form_error('career_level_id'); ?>
	
	Team:
	<?php $team_select = $users_item->team_id; ?>
	<?php $team = array ('1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
	<?php echo form_dropdown('team_id',$team, $team_select); ?> <?php echo form_error('team_id'); ?>

	User Type:
	<?php $usr_type_select = $users_item->user_type; ?>
	<?php $type = array ('User' => 'User', 'Lead' => 'Lead'); ?>
	<?php echo form_dropdown('user_type',$type, $usr_type_select); ?> <?php echo form_error('user_type'); ?>
				
	Tagged as Administrator:
	<?php $admin_select = $users_item->is_admin; ?>
	<?php $is_admin = array ('0' => 'No', '1' => 'Yes'); ?>
	<?php echo form_dropdown('is_admin', $is_admin, $admin_select); ?> <?php echo form_error('is_admin'); ?>
						
	Tagged as Quality Representative:
	<?php $is_qa_rep = array ('0' => 'No', '1' => 'Yes'); ?>
	<?php echo form_dropdown('is_qa_rep',$is_qa_rep); ?> <?php echo form_error('is_qa_rep'); ?>
	
	<?php echo form_submit('submit','Update');?>
    
	<?php echo form_close(); ?>	
	<?php endforeach;?>
																		
</body>