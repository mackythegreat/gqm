<title>Dashboard</title>
<body>
	<div class="container">
		<div class="row" style="text-align:center">
			<div class="col-md-3 well pre-scrollable" style="display:inline-block; text-align:left; float:left; margin-left:10%;" data-spy="scroll" data-offset="10">
			<label><span class="text-danger"></span>Project Catalog</label><br />
				
					
						<?php foreach($projects as $proj_items):?>
							
							<div class="panel-group" id="accordion">
								<?php 
								switch ($proj_items->status) {
									case "Not Started": 
										$panel = "panel panel-danger"; 
									break; 
									case "In Progress": 
										$panel = "panel panel-warning"; 
									break;
									case "Completed": 
										$panel = "panel panel-success"; 
									break;
								}?>
								<div class = '<?php echo $panel; ?>'>
								  <div class="panel-heading">
									<p class="panel-title">
									  <a data-toggle="collapse" data-parent="#accordion" href='<?php echo '#'.$proj_items->proj_id;?>' class='small'> <?php echo $proj_items->proj_name;?></a>
									</p>
								  </div>
								  <div id='<?php echo $proj_items->proj_id;?>' class="panel-collapse collapse out">
									<div class="panel-body">
										<table class='table'>
												<tbody>
													<tr>
														<th>START</th>
														<th>END</th>
														<th>STATUS</th>
													</tr>
													<tr>
														<td><?php echo $proj_items->start_date;?></td>
														<td><?php echo $proj_items->end_date;?></td>
														<td><?php echo $proj_items->status;?></td>
														
													</tr>
												</tbody>
										</table>
										<table class='table'>
										
										<tr>
										<thead><td>TECHNICAL DESIGN</tr><thead>
										<?php foreach ($td as $td_items):?>
											<!-- Technical Design -->
											<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 1)){ ?>
												<td><?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); }?></td>
											<?php } endforeach;?>
										</tr>
										
										<tr>
										<thead><td>ENTRY-EXIT</td><thead>
										<?php foreach ($td as $td_items):?>
											<!-- Entry-exit -->
											<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 2)){ ?>
												<tr><td><?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); }?></td></tr>
											<?php } endforeach;?>
										</tr>
										</table>
									</div>
								  </div>
								</div>
							</div>

						<?php endforeach;?>
						 
				
			</div>
			
			<div class="col-md-3 well" style="display:inline-block; text-align:left; float:none;">
				<label><span class="text-danger"></span>Assigned Tasks</label><br />
				<table class='table'>
					<?php if ($proj_req != FALSE){ ?>
					
					<tbody>
						<?php foreach($proj_req as $preq_items):?>
						<tr>
							<td><?php echo $preq_items->proj_name;?></td>
							<td><?php echo $preq_items->req_name;?></td>
							<!-- START - Modal Placeholder -->
							<td><a href='#' class='update_proj_req btn btn-warning btn-lg btn-xs' data-toggle="modal" data-target="#edit_proj_req_dshbrd" 
								data-pr_id='<?php echo $preq_items->proj_req_id;?>' 
								data-doc_name='<?php echo $preq_items->doc_name;?>'
								data-doc_link='<?php echo $preq_items->doc_link;?>'
								data-rvw_name='<?php echo $preq_items->rvw_name;?>'
								data-rvw_link='<?php echo $preq_items->rvw_link;?>'
								data-status='<?php echo $preq_items->status;?>'
								data-reviewer='<?php echo $preq_items->reviewer;?>'
								data-assignee='<?php echo $preq_items->assignee;?>'
								><span class='glyphicon glyphicon-th-list'></span></a>
							</td>
							<?php $this->view('/modals/edit_proj_req_dshbrd');?>
							<!-- END - Modal Placeholder -->
						</tr>
						<?php endforeach;?>
						
					<?php } else { ?> <hr><?php echo "Congrats! You don't have an assigned task. Enjoy your day!"; }?>	
					</tbody>	 
				</table>
			</div>
			
			<div class="col-md-3 well" style="display:inline-block; text-align:left; float:right; margin-right:10%;">
				<label><span class="text-danger"></span>To-Do List</label><br />
				<?php echo form_open('user/create_todo'); ?>
					

					<div class="input-group">
						<?php echo form_input('task', set_value('task'), 'type="text" class="form-control" placeholder="Add Task Here" style="font-style:italic"'); ?>
						
						<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><span
								class="glyphicon glyphicon-plus"></span></button>
						</span>
					</div> 
					
				<?php echo form_close(); ?>
				
				<br/><br/>
				<table class= "table">
				<?php 
				if(empty($todo_table)){	echo 'No Tasks';} else {?>
					<?php foreach ($todo_table as $item):?>
						<tbody>
							<tr>
								<td><?php echo $item->task;?> </td>
								<td><a class='btn btn-info btn-xs push-right' data-toggle="modal" data-target="#edit_todo" data-id='<?php echo $item->id ?>'>
												<span class='glyphicon glyphicon-edit'></span></a></td>
								<td><a href='<?php echo base_url();?>user/complete_todo/<?php echo $item->id?>' 
												class='btn btn-info btn-xs push-right' data-toggle='tooltip'>
												<span class='glyphicon glyphicon-check'></span></a></td>
							</tr>
						</tbody>
				<?php endforeach; }?>
				</table>
			</div>
		
		</div>
	</div>
	
	<?php $this->view('/modals/edit_todo'); ?>
</body>
