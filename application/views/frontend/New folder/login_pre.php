
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
	<!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Exact login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->

	<!-- Custom Theme files -->
	<link href="<?php echo base_url();?>assets/login/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url();?>assets/login/css/font-awesome.css" rel="stylesheet"> <!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom Theme files -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<!-- web font --> 
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<!-- //web font --> 
	
</head>
<body>
	<!-- main -->
	<div class="main">
		<h1>Login Form</h1>
		<div class="main-w3lsrow">
			<!-- login form -->
			<div class="login-form login-form-left"> 
				<div class="agile-row">
					<div class="head">
						<h2>Login</h2>
						<span class="fa fa-lock"></span>
						<p>
						
                    <?php  if($this->session->flashdata('unnotmatch')){ ?>
                      <span class="help-block"><?php echo $this->session->flashdata('unnotmatch'); ?></span>
                    <?php } ?> 
                
                <?php if($this->session->flashdata('pwdnotmatch')){ ?>                                   
                  <span class="help-block"><?php echo $this->session->flashdata('pwdnotmatch'); ?></span> 
                <?php } ?> 
                 <?php if($this->session->flashdata('logout')){ ?>                                   
                  <span class="help-block"><?php echo $this->session->flashdata('logout'); ?></span> 
                <?php } ?>  
                </p>
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top">

						<form action="<?php echo base_url();?>log" method="POST"> 
							<input type="text" class="name" name="username" Placeholder="Username" required=""/>
							<input type="password" class="password" name="password" Placeholder="Password" required=""/>
							<input type="submit" name="login_save" value="Login Now"> 
							<!-- <input type="text" name="result" id="result"> --> 
						</form> 	
					</div> 
					<div class="login-agileits-bottom"> 
						<h6><a href="#">Forgot your password?</a></h6>
					</div> 
					<input type='text' id='result' style="display: none;">
				</div>  
			</div>  
		</div>
		<!-- //login form -->
		
		<div class="login-agileits-bottom1"> 
			<h3>or login with</h3>
		</div>
		
		<!-- social icons -->
		<div class="social_icons agileinfo">
			<ul class="top-links">
				<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
				<li><a href="#" class="vimeo"><i class="fa fa-vimeo"></i></a></li>
			</ul>
		</div>
		<!-- //social icons -->
		
		<!-- copyright 
		<div class="copyright">
			<p> © 2018 Exact Login Form. All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
		</div>
		//copyright --> 
	</div>	
	<!-- //main -->
	
</body>
</html>



<script  src="<?= base_url()?>assets/login/js/jqueryfile.js"></script> 
<script src='<?= base_url()?>assets/login/js/jquery.form.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$("#log_form").ajaxForm(function(data){
	 $("#result").val(data);
	 var p = $("#result").val();
	 var blank = "";
	 if(p == 'success')
	 {
		 window.location='admin/index.php';
	 }
	 else if(p == 'fail')
	 {
		 alert('check username and password');
	 }
});
</script>

