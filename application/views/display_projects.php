<title>Display All Projects</title>

<body>
		
		<?php $capability = array ('' => 'All', '1' => 'ETL', '2' => '.NET', '3' => 'C++', '4' => 'Java', '5' => 'PHP', '6' => 'PL/SQL', '7' => 'System Test' ); ?>
		
		<?php $status = array ('' => 'All', 'Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'); ?>
		
		<div class="container">
			<div class="row">
				<div class="small col-md-3 well">
				
					<?php if ($this->session->userdata('is_admin') != 1) { ?>
					<div class="hidden">
					<?php } else {?>
					<div class="show">
					<?php } ?>
		
						<?php echo form_open('project/display_projects'); ?></p>
						
							<label><span class="text-danger"><b></b></span> Capability</label><br />
							<?php echo form_dropdown('capability_search', $capability, '', 'class="form-control form-control-lg"'); ?>
							<br />
							
							<label><span class="text-danger"><b></b></span> Type</label><br />
							<?php echo form_dropdown('status_search', $status, '', 'class="form-control form-control-lg"'); ?> 
							<br />
							
							<?php echo form_submit('submit','Filter', "class='btn btn-block btn-warning'");?>
							
							<hr />
						
						<?php echo form_close(); ?>
					</div>
					
					<!--addPRModal Placeholder-->
					
					<?php echo form_button('Add New Project','Add New Project','class="btn btn-info btn-sm pull-left" data-toggle="modal" data-target="#addProjectModal"'); ?>
					<?php $this->view('/modals/add_project');?>
					<!--end of addPRModal Placeholder-->
					
					<hr />
					
					<?php if($this->session->flashdata('message')){ ?> <div class="alert alert-danger text-center"> <?php echo $this->session->flashdata('message'); } ?>
				</div>
			
				<div class="small col-md-9">
					<table class= "table">
					<thead>
						<tr style="background-color:#333;color:#fff;">
							<th class="text-center">PROJECT NAME</th>
							<th class="text-center">ASSIGNED TEAM</th>
							<th class="text-center">START DATE</th>
							<th class="text-center">END DATE</th>
							<th class="text-center">STATUS</th>
							<th colspan = 3  class="text-center">ACTION</th>
						</tr>
					</thead>
					<?php //$count = $this->m_user->get_all_users($offset,$page,$search); ?>
					<?php //if($count->num_rows()>0):?>
				

					<?php foreach ($projects_table as $item):?>
					<tbody>
						<tr>
							<td class="text-center"><?php echo $item->proj_name;?></td>
							<td class="text-center"><?php echo $item->team;?></td>
							<td class="text-center"><?php echo $item->start_date;?></td>
							<?php if($item->end_date == '0000-00-00'){ ?> <td></td>
							<?php } else { ?> <td class="text-center"><?php echo $item->end_date;?></td> <?php }?>
							<td class="text-center"><?php echo $item->status;?></td>
							
							<td><a href='<?php echo base_url().'project/show_project_requirements/'.$item->proj_id?>'
											class="btn btn-success btn-lg btn-xs" data-toggle="tooltip" 
											title="View <?php echo $item->proj_name?>">
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
				<div style="text-align:center">
					<?php if($pagination != false ) { echo $pagination; }	?>
				</div>
				</div>
			</div>
		</div>
</body>
</html>