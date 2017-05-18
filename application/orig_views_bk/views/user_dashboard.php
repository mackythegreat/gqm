
<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
<?php foreach($users_detail as $users_item):?>

	</p>Welcome: <?php echo $users_item->eid; ?> </p>
<?php endforeach;?>

<?php echo anchor('login/logout','Logout'); ?>


<table>
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
	</tbody>	 
</table>


		
