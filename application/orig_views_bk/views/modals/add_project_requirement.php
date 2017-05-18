<!-- Modal -->
  <div class="modal fade" id="addPRModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
		  <?php foreach ($proj_name as $item): endforeach; ?>
          <h4 class="modal-title"><?php echo $item->proj_name; ?></h4>
        </div>
        <div class="modal-body">
		
			
			<?php echo form_open_multipart('project/add_project_requirements'); ?>
			<?php echo form_hidden('proj_id', $item->proj_id); ?>
			<?php echo form_hidden('assigner_id', $this->session->userdata('id'));?>
			
			Requirement: 					
			<select class="form-control" name="req_type_id">
            <?php foreach($req_type_tbl as $req_type){ 
              echo '<option value="'.$req_type->req_type_id.'">'.$req_type->req_name.'</option>';
            }
            ?>
            </select>
			Document Name:
			<?php echo form_input('doc_name', set_value('doc_name'),'class="form-control"'); ?> <?php echo form_error('doc_name'); ?>
			Document Link:
			<?php echo form_input('doc_link', set_value('doc_link'),'class="form-control"'); ?> <?php echo form_error('doc_link'); ?>
			Pointsheet Name:
			<?php echo form_input('rvw_name', set_value('rvw_name'),'class="form-control"'); ?> <?php echo form_error('rvw_name'); ?>
			Pointsheet Link:
			<?php echo form_input('rvw_link', set_value('rvw_link'),'class="form-control"'); ?> <?php echo form_error('rvw_link'); ?>
			Status:
			<?php echo form_dropdown('status', $this->db->enum_select('project_req','status'),'','class="form-control"'); ?>
			Assignee: 					
			<select class="form-control" name="assignee_id">
            <?php foreach($eid as $assignee){ 
              echo '<option value="'.$assignee->id.'">'.$assignee->eid.'</option>';
            }?> </select>
			Reviewer: 					
			<select class="form-control" name="reviewer_id">
            <?php foreach($eid as $reviewer){ 
              echo '<option value="'.$reviewer->id.'">'.$reviewer->eid.'</option>';
            }?> </select>
        </div>
        <div class="modal-footer">
			<?php echo form_submit('submit','Create','class="btn btn-info"');?>
			<?php echo form_close(); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
        </div>
      </div>
      
    </div>
  </div>