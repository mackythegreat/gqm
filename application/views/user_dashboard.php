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
					
									<a class="small dropdown-toggle" data-toggle="collapse" href="<?php echo '#td'.$proj_items->proj_id;?>">

										<span class="glyphicon glyphicon-chevron-down"> TECHNICAL DESIGN</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'td'.$proj_items->proj_id;?>" style="list-style: none;">
								
								
								<?php foreach ($td as $td_items):?>
									
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 1)){ ?>
									<li class="list-group-item small">
										
										
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"');} 
										?>
									</li>
									
									<?php }else {?> <p class="small" style="text-align:center;">No Available Documents</p> 
									<?php break;} endforeach;?>
							</ul>
							</li>
							
							<!-- Build -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#bld'.$proj_items->proj_id;?>">
										<span class="glyphicon glyphicon-chevron-down"> BUILD</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'bld'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 2)){ ?>
									<li class="list-group-item small">
									
									
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); }?>
									</li>
									
									<?php } endforeach;?>
							</ul>
							</li>
							
							<!-- Checklist -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
									<a class="small" data-toggle="collapse" href="<?php echo '#chk'.$proj_items->proj_id;?>">
										<span class="glyphicon glyphicon-chevron-down"> CHECKLIST</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'chk'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 3)){ ?>
									<li class="list-group-item small">
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"');} ?>
									</li>
									<?php }else {?> <p class="small" style="text-align:center;">No Available Documents</p> 
									<?php break;} endforeach;?>
							</ul>
							</li>
							
							<!-- Testing -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#ut'.$proj_items->proj_id;?>">
										<span class="glyphicon glyphicon-chevron-down"> TESTING</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'ut'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 4)){ ?>
									<li class="list-group-item small">
									
									
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); }?>
									</li>
									<?php }else {?> <p class="small" style="text-align:center;">No Available Documents</p> 
									<?php break;} endforeach;?>
							</ul>
							</li>
							
							<!-- MOTM -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#motm'.$proj_items->proj_id;?>">
										<span class="glyphicon glyphicon-chevron-down"> MOTM</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'motm'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<?php if(($td_items->proj_id == $proj_items->proj_id) && ($td_items->req_type_id == 5)){ ?>
									<li class="list-group-item small">
									
									
										<?php if ($td_items->doc_link){ echo anchor($td_items->doc_link, $td_items->doc_name, 'target="_blank"'); }?>
									</li>
									<?php }else {?> <p class="small" style="text-align:center;">No Available Documents</p> 
									<?php break;} endforeach;?>
							</ul>
							</li>
							
							<!-- Review Pointsheet -->
							<li class="librePanelListGroupItem">
							<div class="panel-heading librePanelHeading">
								<div class="panel-title" class="panel">
									<b class="pull-right libreMenuIcon" ></b>
					
									<a class="small" data-toggle="collapse" href="<?php echo '#motm'.$proj_items->proj_id;?>">
										<span class="glyphicon glyphicon-chevron-down"> REVIEW POINTSHEET</span>
									</a>
								</div>
							</div>
							
							<ul class="list-group collapse" id="<?php echo 'motm'.$proj_items->proj_id;?>" style="list-style: none;">
								<?php foreach ($td as $td_items):?>
									<li class="list-group-item small">
										<?php if ($td_items->doc_link){ echo anchor($td_items->rvw_link, $td_items->rvw_name, 'target="_blank"'); ?>
									</li>
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
						<?php echo form_input('title', set_value('title'), 'type="text" class="form-control" placeholder="Add Task Here" style="font-style:italic"'); ?>
						
						<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><span
								class="glyphicon glyphicon-plus"></span></button>
						</span>
					</div> 
					
				<?php echo form_close(); ?>
				<hr/>
				

				<?php
					function time_ago( $time )
					{
						$out    = ''; // what we will print out
						$now    = time(); // current time
						$diff   = $now - $time; // difference between the current and the provided dates
				
						if( $diff < 60 ) // it happened now
							return TIMEBEFORE_NOW;
				
						elseif( $diff < 3600 ) // it happened X minutes ago
							return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );
				
						elseif( $diff < 3600 * 24 ) // it happened X hours ago
							return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );
				
						elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
							return TIMEBEFORE_YESTERDAY;
				
						else // falling back on a usual date format as it happened later than yesterday
							return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
					}
					
					
					function time_passed($timestamp)
					{
						$diff = time() - (int)$timestamp;

						if ($diff == 0) 
							return 'just now';
					
						$intervals = array
						(
							1                   => array('year',    31556926),
							$diff < 31556926    => array('month',   2628000),
							$diff < 2629744     => array('week',    604800),
							$diff < 604800      => array('day',     86400),
							$diff < 86400       => array('hour',    3600),
							$diff < 3600        => array('minute',  60),
							$diff < 60          => array('second',  1)
						);
					
						$value = floor($diff/$intervals[1][1]);
						return $value.' '.$intervals[1][0].($value > 1 ? 's' : '').' ago';
					}
				?>
				
				
				
				<div class="panel-group">
				<?php foreach ($todo_table as $task_item):

					
					switch ($proj_items->status) {
						case "Not Started": 
							$task_color = "panel panel-danger"; 
						break; 
						case "In Progress": 
							$task_color = "panel panel-warning"; 
						break;
						case "Completed": 
							$task_color = "panel panel-danger"; 
						break;

				}
				
				//echo time_passed(strtotime('\"'.$task_item->create_date.'\"'));
				?>
				
				<div class="panel panel-danger">
					<div class='panel-heading' data-toggle="tooltip" title='<?php echo $task_item->extra_notes; ?>'>
					
						
						<a class='update_task btn btn-xs pull-right' style='margin-left: 5px;' data-toggle="modal" 
						data-target="#edit_todo" 
						
						data-tsk_id='<?php echo $task_item->id; ?>'
						data-tsk_title='<?php echo $task_item->title; ?>'
						data-tsk_ext_notes='<?php echo $task_item->extra_notes; ?>'
						data-tsk_tg_date='<?php echo $task_item->target_date; ?>'
						><span class='glyphicon glyphicon-pencil'></span></a>
						
			
						
						
						<a href='<?php echo base_url();?>user/complete_todo/<?php echo $task_item->id?>' 
						class='btn btn-xs pull-right' style='margin-left: 20px;' data-toggle='tooltip'>
						<span class='glyphicon glyphicon-check'></span></a>
									

						<a class="small" data-toggle="collapse" href="<?php echo '#'.$task_item->id;?>">
							<span><?php echo $task_item->title;?></span>
						</a>
						</div>
						
					
					</div>
				<?php endforeach; ?>
				</div>
				
				
			</div>
		
		</div>
	</div>
	
	<?php $this->view('/modals/edit_todo'); ?>
</body>
