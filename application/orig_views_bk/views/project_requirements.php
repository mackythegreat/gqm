
<title>Display All Users</title>

<body>
	<p>Welcome: <?php echo $this->session->userdata('eid'); ?>	<?php echo anchor('login/logout','logout'); ?> </p>
											
		<?php echo $title.": "?><?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
		
		<div class="container">		
			<div class="table-responsive">
				<table class= "table">
					<thead>
						<tr >
							<th>REQUIREMENT</th>
							<th>DOCUMENT</th>
							<th>ASSIGNEE</th>
							<th>POINTSHEET</th>
							<th>REVIEWER</th>
							<th>ASSIGNER</th>
							<th>STATUS</th>
							<th colspan = 3>ACTION</th>
						</tr>
					</thead>
					<?php //$count = $this->m_user->get_all_users($offset,$page,$search); ?>
					<?php //if($count->num_rows()>0):?>
				
					<tbody>
					<?php if(empty($proj_req_tbl)) {?>	
						<tr>
							<td colspan=10>No assigned requirements yet.</td>
						</tr>
					<?php } else { ?>
				
					<?php foreach ($proj_req_tbl as $item):?>
					
						<tr>
							<td><?php echo $item->req_name;?></td>
							<td><?php if ($item->doc_link){ echo anchor($item->doc_link, $item->doc_name, 'target="_blank"'); }?></td>
							<td><?php echo $item->assignee;?></td>
							<td><?php if ($item->rvw_link){ echo anchor($item->rvw_link, $item->rvw_name, 'target="_blank"'); }?></td>
							<td><?php echo $item->reviewer;?></td>
							<td><?php echo $item->assigner;?></td>
							
							<?php 
								switch($item->status)
								{
									case "Not Started":
										$class = 'class="bg-danger text-danger "';
										break;
									case "In Progress":
										$class = 'class="bg-warning text-warning"';
										break;
									case "For Review":
										$class = 'class="bg-info text-info"';
										break;
									case "Approved":
										$class = 'class="bg-success text-success"';
										break;
								}
							?>
							<td <?php echo $class;?> ><?php echo $item->status;?></td>
							
						</tr>
					</tbody>
					<?php endforeach;  ?>
					<?php form_close(); }?>
					<?php //endif; ?>
				</table>
				
	

	<!--addPRModal Placeholder-->
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPRModal" data-id='<?php echo $item->proj_req_id;?>'>Add New Requirement</button>
	<?php $this->view('/modals/add_project_requirement');?>
	<!--end of addPRModal Placeholder-->
	
		</div>
		</div>
	
	<?php //echo $count->num_rows();?>




	<p><?php// echo $pagination;?></p>
								
					
</body>
</html>