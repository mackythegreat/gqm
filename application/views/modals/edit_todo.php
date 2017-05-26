<script type="text/javascript">

$(document).on("click", ".update_task", function () {
     /* Assign the value of data-xxx to the variables */
	 var tsk_id = $(this).data('tsk_id');
	 var tsk_title = $(this).data('tsk_title');
	 var tsk_ext_notes = $(this).data('tsk_ext_notes');
	 var tsk_tg_date = $(this).data('tsk_tg_date');

	 /* Fill the form inside modal-body using the id */
	 $(".modal-body #tsk_id").val( tsk_id );
	 $(".modal-body #tsk_title").val( tsk_title );
	 $(".modal-body #tsk_ext_notes").val( tsk_ext_notes );
	 $(".modal-body #tsk_tg_date").val( tsk_tg_date );
});
</script>


<!-- Modal -->
<div id="edit_todo" class="modal fade" role="dialog">
	<div class="modal-dialog">
	
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit To-Do Item</h4>
			</div>
			
			<div class="modal-body">
				<?php echo form_open_multipart('user/update_todo/'); ?>
					
				<?php echo form_input('tsk_id','','class="form-control hidden" id="tsk_id" readonly'); ?>
				
				<label><span class="text-danger"></span> Title</label><br />
				<?php echo form_input('tsk_title', /*value*/'','class="form-control" id="tsk_title"'); ?> <?php echo form_error('tsk_title'); ?>
				
				<label><span class="text-danger"></span> Extra Notes</label><br />
				<?php echo form_input('tsk_ext_notes', /*value*/'','class="form-control" id="tsk_ext_notes"'); ?> <?php echo form_error('tsk_ext_notes'); ?>
				
				
				
				
				
				<label><span class="text-danger"></span> Target Date</label><br />
				<?php echo form_input('tsk_tg_date', /*value*/'','class="form-control" id="tsk_tg_date"'); ?> <?php echo form_error('tsk_tg_date'); ?>
				
				
				
				
				
				
			
			</div>
			
			<div class="modal-footer">
				<?php echo form_submit('submit','Update','class="btn btn-info"');?>
			<?php echo form_close(); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
			</div>
		</div>
	</div>
</div>