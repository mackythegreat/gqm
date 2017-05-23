<!DOCTYPE html>
<html ng-app="app">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
		<!-- <meta http-equiv="refresh" content="5" /> -->
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		
		<!--Start Style Sheet Area-->
		<link rel="stylesheet" href='<?php echo base_url();?>bootstrap/css/bootstrap.min.css' type="text/css"/> 
		<link rel="stylesheet" href='<?php echo base_url();?>datepicker/css/bootstrap-datepicker3.standalone.css' type="text/css"/> 
		<link rel="stylesheet" href='<?php echo base_url();?>datepicker/css/bootstrap-datepicker3.standalone.min.css' type="text/css"/> 
		
		<script type="text/javascript" src='<?php echo base_url();?>bootstrap/js/jquery.js'></script>
		<script type="text/javascript" src='<?php echo base_url();?>bootstrap/js/bootstrap.min.js'></script>
		<script type="text/javascript" src="<?php echo base_url();?>datepicker/js/bootstrap-datepicker.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo base_url();?>datepicker/js/bootstrap-datepicker.min.js" charset="utf-8"></script>
		
		<script type="text/javascript" src='<?php echo base_url();?>jquery.validate.min.js'></script>
		<script type="text/javascript" src='<?php echo base_url();?>angular/angular.min.js'></script>
		<script type="text/javascript" src='<?php echo base_url();?>angular/gqm_validation.js'></script>
		<script type="text/javascript" src='<?php echo base_url();?>angular/angular-messages.js'></script>
		<!--End Style Sheet Area-->
		
	</head>
	
	<nav class="navbar navbar-light navbar-static-top" style="background-color: #333">
		<h3 style="margin-left:70px">
			<font color="#fff" style="font-weight: bold">Gaea Quality Manager</font>
			
			<?php if($this->session->userdata('eid')) { ?>
			<span class="dropdown pull-right" style="margin-right:100px;">
			<button class="btn btn-success dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				<span class="glyphicon glyphicon-align-justify"></span> Menu
				<span class="caret"></span>
			</button>
			
			
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		
				
				<li><a href='<?php echo base_url();?>./user/user_dashboard'><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
				<li role="separator" class="divider" ></li>
				
				<?php if(($this->session->userdata('is_admin') != 0) || ($this->session->userdata('user_type') != "User")) { ?>
					<li><a href='<?php echo base_url();?>./user/display_users'><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>	
				<?php } ?>
					
				<?php if(($this->session->userdata('is_admin') != 0) || ($this->session->userdata('user_type') != "User") || ($this->session->userdata('is_qa_rep') != 0)) {?>
					<li><a href='<?php echo base_url();?>./project/display_projects'><span class="glyphicon glyphicon-tasks"></span> Manage Projects</a></li>
					<li role="separator" class="divider"></li>
				<?php }?>
				
				
				<li><a href='<?php echo base_url();?>./user/change_password'><span class="glyphicon glyphicon-cog"></span> Change Password</a></li>
				<li><a href='<?php echo base_url();?>./login/logout'><span class="glyphicon glyphicon-off"></span> Logout</a></li>
				<!-- <li role="separator" class="divider"></li> -->
				
			</ul>
			<?php } ?>
			 
			</span>
		</h3>
	</nav>