<title>Dashboard</title>
<body>
	<div class="container">
		<div class="row" style="text-align:center">
		
			<div class="col-md-4 well" style="display:inline-block; text-align:left; float:left;" data-spy="scroll" data-offset="10">
				<h3>Project Catalog</h3>
				
				<div class="panel panel-default">
				
				<?php foreach($projects as $proj_items):
					
					switch ($proj_items->status) {
						case "Not Started": 
							$folder_color = "color:#d9534f;"; 
						break; 
						case "In Progress": 
							$folder_color = "color:#f0ad4e;"; 
						break;
						case "Completed": 
							$folder_color = "color:#5cb85c;"; 
						break;
				}?>
				

				<div class="panel-heading librePanelHeading">
					<div class="panel-title" class="panel">
						<b class="pull-right glyphicon glyphicon-folder-close libreMenuIcon" style='<?php echo $folder_color;?>'></b>

						<a class="small" data-toggle="collapse" href="<?php echo '#'.$proj_items->proj_id;?>">
							<span><?php echo $proj_items->proj_name;?></span>
						</a>
					</div>
				</div>
					
					<ul class="list-group collapse" id="<?php echo $proj_items->proj_id;?>" style="list-style: none;">
					
						<!--<div id='<?php echo $proj_items->proj_id;?>' class="panel-collapse collapse out">-->
						<div class="panel-body">
							
							<li class="list-group-item librePanelListGroupItem">
								<table class="table">
									<tbody>
										<tr style="background-color:#333;color:#fff;">
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
							</li>
							
							<!-- Technical Design -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#td'.$proj_items->proj_id;?>">
										<span>TECHNICAL DESIGN</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'td'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 1)){ ?>
									<li class="list-group-item small">
									
									
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); ?>
									</li>
									<?php }?>
								<?php } endforeach;?>
							</ul>
							</li>
							
							<!-- Build -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#bld'.$proj_items->proj_id;?>">
										<span>BUILD </span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'bld'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 2)){ ?>
									<li class="list-group-item small">
									
									
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); ?>
									</li>
									<?php }?>
								<?php } endforeach;?>
							</ul>
							</li>
							
							<!-- Checklist -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
									<a class="small" data-toggle="collapse" href="<?php echo '#chk'.$proj_items->proj_id;?>">
										<span>CHECKLIST</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'chk'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 3)){ ?>
									<li class="list-group-item small">
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); ?>
									</li>
									<?php }?>
								<?php } endforeach;?>
							</ul>
							</li>
							
							<!-- Testing -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#ut'.$proj_items->proj_id;?>">
										<span>TESTING</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'ut'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 4)){ ?>
									<li class="list-group-item small">
									
									
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); ?>
									</li>
									<?php }?>
								<?php } endforeach;?>
							</ul>
							</li>
							
							<!-- MOTM -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#motm'.$proj_items->proj_id;?>">
										<span>MOTM</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'motm'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 5)){ ?>
									<li class="list-group-item small">
									
									
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); ?>
									</li>
									<?php }?>
								<?php } endforeach;?>
							</ul>
							</li>

						</div>
						<!--</div>-->
					</ul>


				<?php endforeach;?>

						 
				
			</div>
			</div>
			
			<div class="col-md-4 well" style="display:inline-block; text-align:left; float:none;">
				<h3>Assigned Tasks</h3>
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
			
			<div class="col-md-3 well" style="display:inline-block; text-align:left; float:right;">
				<h3>To-Do List</h3>
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
