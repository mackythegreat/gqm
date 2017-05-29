<script type="text/javascript">

$(document).on("click", ".update_proj_req", function () {
     /* Assign the value of data-xxx to the variables */
	 var pr_id = $(this).data('pr_id');
	 var doc_name = $(this).data('doc_name');
	 var doc_link = $(this).data('doc_link');
	 var rvw_name = $(this).data('rvw_name');
	 var rvw_link = $(this).data('rvw_link');
     var status = $(this).data('status');
	 var reviewer = $(this).data('reviewer');
     var assignee = $(this).data('assignee');
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
        <div class="modal-header" style="background-color:#333;color:#fff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Requirement</h4>
        </div>
        <div class="modal-body small">
			<div class="row">
				<div class="col-md-8">
					<?php echo form_open_multipart('project/update_proj_req_dshbrd/'); ?>
					
					<?php echo form_input('proj_req_id','<a href=>','class="form-control hidden" id="pr_id" readonly'); ?>
				
				
					<label class="mod-header"> Document Name</label><br />
					<?php echo form_input('doc_name', /*value*/'','class="form-control" id="doc_name"'); ?> <?php echo form_error('doc_name'); ?>
						
					<br />
					<label> Document Link</label><br />
					<?php echo form_input('doc_link', /*value*/'','class="form-control" id="doc_link"'); ?> <?php echo form_error('doc_link'); ?>
					
					<hr>
				</div>
				
				<div class="col-md-4">
					<label> Assignee</label><br />
						<?php echo form_input('assignee', /*value*/'','class="form-control" id="assignee" readonly'); ?> <?php echo form_error('assignee'); ?>
				</div>
			</div>
				
			<div class="row">
				<div class="col-md-8">
					<label> Pointsheet Name</label><br />
						<?php echo form_input('rvw_name', /*value*/'','class="form-control" id="rvw_name"'); ?> <?php echo form_error('rvw_name'); ?>
					
					<br />
					<label> Pointsheet Link</label><br />
						<?php echo form_input('rvw_link', /*value*/'','class="form-control" id="rvw_link"'); ?> <?php echo form_error('rvw_link'); ?>
					<hr>
				</div>
				
				<div class="col-md-4">
					<label> Reviewer</label><br />
					<?php echo form_input('reviewer', /*value*/'','class="form-control" id="reviewer" readonly'); ?> <?php echo form_error('reviewer'); ?>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-md-8">
					<label> Status</label><br />
					<?php echo form_dropdown('status', $this->db->enum_select('project_req','status'),'','class="form-control" id="status"'); ?>
				</div>
			</div>
		</div>

		<div class="modal-footer" >
			<?php echo form_submit('submit','Update','class="btn btn-info"');?>
			<?php echo form_close(); ?>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
		</div>
	</div>
</div>