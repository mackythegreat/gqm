	<?php $this->load->view('header'); ?>
	
	<body style="background-color:#f5f5f5;">
		<?php if($this->session->flashdata('error')){  echo $this->session->flashdata('error'); } ?>
	
		<?php echo form_open('login/authenticate'); ?>
		
		<div class="col-md-4 col-md-offset-4" style="margin-top:100px;">
			<div class="panel-body">
					<h3>
						<font color="#3d3d3d" style="font-weight: bold;" class="centered-text">GQM</font>
					</h3>
					
				<form role="form" name="loginform" >
					<fieldset>
						<!-- Enterprise ID -->
						<div class="form-group">
							<input class="form-control" placeholder="EID" name="eid" type="text" required style="font-style:italic">
							
							<?php echo form_error('eid'); ?> <!--error message-->
						</div>
						
						<!-- Password -->
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" 
							type="password" minlength="5" required style="font-style:italic">
							
							<?php echo form_error('password'); ?> <!--error message-->
						</div>
						
						<!-- Sign In Button -->
						<div class="form-group">
							<input type="submit" name="Submit" value="Sign In" class="btn btn-block btn-warning">
						</div>
						
						<?php echo form_close(); ?>
					</fieldset>
				</form>
			</div>
		</div>
		