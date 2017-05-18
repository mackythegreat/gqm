
<html lang="en">
<head>
	<title>Change Password</title>	
</head>
<body>
			<?php $this->load->view('header'); ?>
		<?php foreach($user_detail as $item):?>
			<?php echo form_open_multipart('user/change_password/'.$item->eid); ?>
						
				<body style="background-color:#f5f5f5;">
		<?php if($this->session->flashdata('message')){  echo $this->session->flashdata('message'); } ?>
		
		<div class="col-md-4 col-md-offset-4" style="margin-top:100px;">
			<div class="panel-body">
					<h3>
						<font color="#3d3d3d" style="font-weight: bold;" class="centered-text">Change Password</font>
					</h3>
					
				<form role="form" name="loginform" >
					<fieldset>
						<!-- Enterprise ID -->
						<div class="form-group">
							<input class="form-control" placeholder="New Password" name="password" type="password" minlength="5" 
							required style="font-style:italic">
							
							<?php echo form_error('password'); ?> <!--error message-->
						</div>
						
						<!-- Password -->
						<div class="form-group">
							<input class="form-control" placeholder="Confirm Password" name="confirm_password" 
							type="password" minlength="5" required style="font-style:italic">
							
							<?php echo form_error('confirm_password'); ?> <!--error message-->
						</div>
						
						<!-- Sign In Button -->
						<div class="form-group">
							<input type="submit" name="Change Password" value="Change Password" class="btn btn-block btn-warning">
						</div>
						
						<?php echo form_close(); ?>
					</fieldset>
				</form>
			</div>
		</div>		
						
	
		<?php endforeach;?>
	<?php echo form_close(); ?>
		
</body>
</html>