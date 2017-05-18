
<title>Display All Users</title>

<body>
	<p>Welcome: <?php echo $this->session->userdata('eid'); ?>	<?php echo anchor('login/logout','logout'); ?> </p>
	
		<?php if ($this->session->userdata('is_admin') != 1) { ?>
		<div class="hidden">
		<?php } else {?>
		<div class="show">
		<?php } ?>
		
		
	    <?php $capability = array ('' => 'All', '1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
		
		<?php $user_type = array ('' => 'All', 'User' => 'User', 'Lead' => 'Lead'); ?>
		
		<?php echo form_open('user/display_users'); ?></p>	
			<p>Capability: <?php echo form_dropdown('capability_search', $capability); ?>
			Type: <?php echo form_dropdown('usertype_search', $user_type); ?> 
			<?php echo form_submit('submit','Filter');?> </p>
			</div>
		<?php echo form_close(); ?>
											
		<?php echo $title.": "?><?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
		
		<?php echo anchor('user/add_user','Add New Resource'); ?>
		
		<div class="container">		
			<div class="table-responsive">
				<table class= "table">
					<thead>
						<tr >
							<th></th>
							<th>ENTERPRISE ID</th>
							<th>CAREER LEVEL</th>
							<th>TYPE</th>
							<th>CAPABILITY</th>
							<th colspan = 3">ACTION</th>
						</tr>
					</thead>
					<?php //$count = $this->m_user->get_all_users($offset,$page,$search); ?>
					<?php //if($count->num_rows()>0):?>
					<?php echo form_open('user/batch_reset'); ?>

					<?php foreach ($users_table as $users_item):?>
					<tbody>
						<tr>
							<td><?php echo form_checkbox('eid[]',$users_item->eid,FALSE); ?></td>
							<td><?php echo $users_item->eid;?></td>
							<td><?php echo $users_item->title;?></td>
							<td><?php echo $users_item->user_type;?></td>
							<td><?php echo $users_item->team;?></td>
							
							<td><?php echo "<a href='/gaea/user/update_user/$users_item->eid' 
											class='btn btn-info btn-lg btn-xs' data-toggle='tooltip' 
											title='Edit $users_item->eid information'>
											<span class='glyphicon glyphicon-pencil'></span></a>" ;?></td>
							
							<td><?php echo "<a href='/gaea/user/reset_password/$users_item->eid' 
											class='btn btn-warning btn-lg btn-xs' data-toggle='tooltip' 
											title='Reset $users_item->eid password'>
											<span class='glyphicon glyphicon-refresh'></span></a>" ;?></td>
						
						
							<?php 
							if($this->session->userdata('is_admin')!=1 ) { 
								$td = '<td class = "hidden">';
							} else { 
								$td = '<td class = "show">';
							} ?>
							<?php if($users_item->is_active != 0){?>
								<?php echo " $td <a href='/gaea/user/set_to_inactive/$users_item->eid' class='btn btn-danger btn-lg btn-xs' data-toggle='tooltip' title='Deactivate $users_item->eid'>
									<span class='glyphicon glyphicon-ban-circle'></span></a>" ;?></td>
							<?php }else{ ?>
								<?php echo " $td <a href='/gaea/user/set_to_active/$users_item->eid' class='btn btn-success btn-lg btn-xs' data-toggle='tooltip' title='Reactivate $users_item->eid'>
									<span class='glyphicon glyphicon-ok-circle'></span></a>" ;?></td>
							<?php } ?>
							
						
						</tr>
					</tbody>
					<?php endforeach;?>
					<?php form_close(); ?>
					<?php //endif; ?>
				</table>
	
		</div>
		</div>
	<?php echo form_submit('submit','Reset Password');?> 
	<?php //echo $count->num_rows();?>




	<p><?php// echo $pagination;?></p>
								
					
</body>
</html>