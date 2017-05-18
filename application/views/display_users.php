<title>Display All Users</title>

<body>

		
	<?php $capability = array ('' => 'All', '1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
	
	<?php $user_type = array ('' => 'All', 'User' => 'User', 'Lead' => 'Lead'); ?>
	
	
	<div class="container">
		<div class="row">
			<div class="small col-md-3 well">
		
				<?php if ($this->session->userdata('is_admin') != 1) { ?> <div class="hidden"> <?php } else { ?> <div class="show"> <?php } ?>
				
					<?php echo form_open('user/filter'); ?></p>
						<label><span class="text-danger"><b></b></span> Capability</label><br />
						<?php echo form_dropdown('capability_search', $capability, '', 'class="form-control form-control-lg"'); ?> 
						<br />
						
						<label><span class="text-danger"><b></b></span> Type</label><br />
						<?php echo form_dropdown('usertype_search', $user_type, '', 'class="form-control form-control-lg"'); ?> 
						<br />
	
						<?php echo form_submit('submit','Filter', "class='btn btn-block btn-warning'");?>
						
					<?php echo form_close(); ?>
					
					<hr />
					
					<?php if($this->session->flashdata('message')){ ?> <div class="alert alert-danger text-center"> <?php echo $this->session->flashdata('message'); ?> </div> <?php } ?>
				</div>
			</div>
			
			<!-- START additional div -->
			
			
			<div class="col-md-3">
			
			</div>
			
			<div class="col-md-3">
			<?php echo anchor('user/add_user','Export To Excel', "class='btn btn-success btn-sm'"); ?>
			
			<!--addPRModal Placeholder-->
				<!--<button type="button" class="class='btn btn-primary btn-sm pull-left" data-toggle="modal" data-target="#addUserModal">Add New Resource</button>-->
				<?php echo form_button('Add New Resource','Add New Resource','class="btn btn-info btn-sm pull-left" data-toggle="modal" data-target="#addUserModal"'); ?>
				<?php $this->view('/modals/add_user');?>
			<!--end of addPRModal Placeholder-->
			
			</div>
			
			<div class="col-md-3">
			<?php //echo form_open('user/batch_reset/'.$uri); ?>
			<?php echo form_open('user/batch_reset/'); ?>
			<?php echo form_submit('submit','Reset Password', "class='btn btn-primary btn-sm pull-left'");?> 
			</div>
			
			<!-- END -->
			
			<div class="col-md-9">
				<br/>
			</div>
			
			
			<div class="col-md-9">
				<table class= "table small">
					<thead>
						<tr style="background-color:#333;color:#fff;">
							<th></th>
							<th class="text-center">ENTERPRISE ID</th>
							<th class="text-center">CAREER LEVEL</th>
							<th class="text-center">TYPE</th>
							<th class="text-center">CAPABILITY</th>
							<th colspan = 3" class="text-center">ACTION</th>
						</tr>
					</thead>
					<?php //$count = $this->m_user->get_all_users($offset,$page,$search); ?>
					<?php //if($count->num_rows()>0):?>
					
					<?php foreach ($users_table as $users_item):?>
						<tbody>
							<tr>
								<td><?php echo form_checkbox('id[]',$users_item->id,FALSE); ?></td>
								
								
								<td><?php echo $users_item->eid;?></td>
								
								<td class="text-center"><?php echo $users_item->title;?></td>
								<td class="text-center"><?php echo $users_item->user_type;?></td>
								<td class="text-center"><?php echo $users_item->team;?></td>
								
								<td><a href='<?php echo base_url();?>user/update_user/<?php echo $users_item->id?>' 
												class='btn btn-info btn-lg btn-xs' data-toggle='tooltip' 
												title='Edit <?php echo $users_item->eid ?> information'>
												<span class='glyphicon glyphicon-pencil'></span></a></td>
								
								<td><a href='<?php echo base_url();?>user/reset_password/<?php echo $users_item->id?>/<?php echo $users_item->eid?>'
												class='btn btn-warning btn-lg btn-xs' data-toggle='tooltip' 
												title='Reset <?php echo $users_item->eid ?> password'>
												<span class='glyphicon glyphicon-refresh'></span></a></td>
								
								<?php if($this->session->userdata('is_admin')!=1 ) { $td = '<td class = "hidden">'; } 
								else { $td = '<td class = "show">';}?>
							
								<?php if($users_item->is_active != 0){ echo $td ?>
									<a href='<?php echo base_url();?>user/set_to_inactive/<?php echo $users_item->id?>/<?php echo $users_item->eid?>' class='btn btn-danger btn-lg btn-xs' data-toggle='tooltip' title='Deactivate <?php echo $users_item->eid ?>'>
										<span class='glyphicon glyphicon-ban-circle'></span></a></td>
								<?php } else{ echo $td ?>
									<a href='<?php echo base_url();?>user/set_to_active/<?php echo $users_item->id?>/<?php echo $users_item->eid?>' class='btn btn-success btn-lg btn-xs' data-toggle='tooltip' title='Reactivate <?php echo $users_item->eid?>'>
										<span class='glyphicon glyphicon-ok-circle'></span></a></td>
								<?php } ?>
							</tr>
						</tbody>
					<?php endforeach;?>
					
					
					<?php form_close(); ?>
				</table>
				<div style="text-align:center">
					<?php if($pagination != false ) { echo $pagination; }	?>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>