<script type="text/javascript">

$(document).on("click", ".update_user", function () {
     /* Assign the value of data-xxx to the variables */
	 
	 var eid = $(this).data('eid');
	 var career_level_id = $(this).data('level');
	 var user_type = $(this).data('user_type');
	 var is_admin = $(this).data('is_admin');
	 var is_qa_rep = $(this).data('is_qa_rep');
     
	 /* Fill the form inside modal-body using the id */
	 $(".modal-body #pr_id").val( pr_id );
	 $(".modal-body #doc_name").val( doc_name );
	 $(".modal-body #doc_link").val( doc_link );
	 $(".modal-body #rvw_name").val( rvw_name );
	 $(".modal-body #rvw_link").val( rvw_link );
	 $(".modal-body #status").val( status );
	 $(".modal-body #reviewer").val( reviewer );
	 $(".modal-body #assignee").val( assignee ); 
});
</script>

<!-- Modal -->
  <div class="modal fade" id="edit_proj_req_dshbrd" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Requirement</h4>
        </div>
        <div class="modal-body">
		
		<?php echo form_open_multipart('project/update_proj_req_dshbrd/'); ?>
		
		<?php echo form_input('proj_req_id','','class="form-control hidden" id="pr_id" readonly'); ?>
		Document Name:
			<?php echo form_input('doc_name', /*value*/'','class="form-control" id="doc_name"'); ?> <?php echo form_error('doc_name'); ?>
		Document Link:
			<?php echo form_input('doc_link', /*value*/'','class="form-control" id="doc_link"'); ?> <?php echo form_error('doc_link'); ?>
        Pointsheet Name:
			<?php echo form_input('rvw_name', /*value*/'','class="form-control" id="rvw_name"'); ?> <?php echo form_error('rvw_name'); ?>
		Pointsheet Link:
			<?php echo form_input('rvw_link', /*value*/'','class="form-control" id="rvw_link"'); ?> <?php echo form_error('rvw_link'); ?>
		Status:
			<?php echo form_dropdown('status', $this->db->enum_select('project_req','status'),'','class="form-control" id="status"'); ?>
		Assignee:
			<?php echo form_input('assignee', /*value*/'','class="form-control" id="assignee" readonly'); ?> <?php echo form_error('assignee'); ?>
		Reviewer:
			<?php echo form_input('reviewer', /*value*/'','class="form-control" id="reviewer" readonly'); ?> <?php echo form_error('reviewer'); ?>
		
		</div>
        <div class="modal-footer">
			<?php echo form_submit('submit','Update','class="btn btn-info"');?>
			<?php echo form_close(); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
        </div>
      </div>
      
    </div>
  </div>