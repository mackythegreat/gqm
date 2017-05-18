
<title>Display All Users</title>

<body>
	<p>Welcome: <?php echo $this->session->userdata('eid'); ?>	<?php echo anchor('login/logout','logout'); ?> </p>
	
		<?php echo form_open('project/display_projects'); ?></p>
		<?php if ($this->session->userdata('is_admin') != 1) { ?>
		<div class="hidden">
		<?php } else {?>
		<div class="show">
		<?php } ?>
		
		
	    <?php $capability = array ('' => 'All', '1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
		
		<?php $status = array ('' => 'All', 'Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
		
			
			<p>Capability: <?php echo form_dropdown('capability_search', $capability); ?>
			
			</div>
			Status: <?php echo form_dropdown('status_search', $status); ?> 
			<?php echo form_submit('submit','Filter');?> </p>
		<?php echo form_close(); ?>
											
		<?php echo $title.": "?><?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
		
		<?php echo anchor('project/add_project','Add New Project'); ?>
		
		<div class="container">		
			<div class="table-responsive">
				<table class= "table">
					<thead>
						<tr >
							
							<th>PROJECT NAME</th>
							<th>ASSIGNED TEAM</th>
							<th>START DATE</th>
							<th>END DATE</th>
							<th>STATUS</th>
							<th colspan = 3>ACTION</th>
						</tr>
					</thead>
					<?php //$count = $this->m_user->get_all_users($offset,$page,$search); ?>
					<?php //if($count->num_rows()>0):?>
				

					<?php foreach ($projects_table as $item):?>
					<tbody>
						<tr>
							<td><?php echo $item->proj_name;?></td>
							<td><?php echo $item->team;?></td>
							<td><?php echo $item->start_date;?></td>
							<?php if($item->end_date == '0000-00-00'){ ?> <td></td>
							<?php } else { ?> <td><?php echo $item->end_date;?></td> <?php }?>
							<td><?php echo $item->status;?></td>
							
							<td><a href='<?php echo base_url().'project/show_project_requirements/'.$item->proj_id?>'
											class="btn btn-success btn-lg btn-xs" data-toggle="tooltip" 
											title="Edit <?php echo $item->proj_name?>">
											<span class='glyphicon glyphicon-folder-open'></span></a></td>
							
							<td><a href='<?php echo base_url().'project/update_project/'.$item->proj_id?>'
											class="btn btn-info btn-lg btn-xs" data-toggle="tooltip" 
											title="Edit <?php echo $item->proj_name?>">
											<span class='glyphicon glyphicon-pencil'></span></a></td>
						</tr>
					</tbody>
					<?php endforeach;?>
					<?php form_close(); ?>
					<?php //endif; ?>
				</table>
	
		</div>
		</div>						
					
</body>
</html>