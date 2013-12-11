<!DOCTYPE html>
<html lang="en">
	<head>	
		<title>IconX CMS Administration</title>		
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<meta name='description' content='IconX' />
		<meta name="author" content="jhoana">
		<meta name="viewport" content="width=device-width">		
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/validate_form.js"></script>		
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/admin/stylesheet.css?<?php echo time(); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/admin/<?php echo $page; ?>.css?<?php echo time(); ?>" type="text/css" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>_assets/images/favicon.png">
	</head>	
	<body>
		<div id="container">
		<?php if ($this->session->userdata('logged_in')) { ?>

			Your are logged in as <?php echo $this->session->userdata('username'); ?><br/>

		<?php } else { ?>

			<div id="login_body">
				<div id="login_design"></div>
				<div id="login_wrapper">
				<div id="login_wrapper_inner">
					<div id="login_message"></div>
					<div id="login_header">Login</div>
					<!--<img src="<?php echo base_url(); ?>_assets/images/login.png" id="login_icon" />-->
					<div id="login_elements">
					<form id="form_login" action="<?php echo base_url(); ?>admin/dashboard" method="POST">
						<input 	type="text" 
								id="input_user" 
								name="username" 
								data-required="1"				
								placeholder="Username" />
						<input 	type="password" 
								id="input_pass" 
								name="password" 
								data-required="1"				
								placeholder="Password" />
						<input type="submit" id="button_login" value="Login" />
						<div class="clearboth"></div>
					</form>
					</div>
					<div class="clearboth"></div>
				</div>
				</div>
			</div>
			<script type="text/javascript" language="javascript">
			$(function(){
				$("#input_user").focus();
				
				$(document).keypress(function(e) {
					if ($("#input_user").is(":focus") || $("#input_pass").is(":focus")) { 
						if (e.which == 13) { tryLogin(); }
					}
				});
			});
			$("#button_login").click(function(e){ 
				e.preventDefault();
				tryLogin();
			
			});

			function tryLogin()
			{
				
				$("#login_message").html("Checking user credentials");
				//$("#button_login").attr('disabled', 'disabled');
				if (validate_form("form_login")) {

					$.ajax({
						url: "<?php echo base_url(); ?>login/process_login",
						//url: "<?php echo base_url(); ?>login/process_login_ldap",
						type: "POST",
						data: $("#form_login").serialize(),
						success: function(response, textStatus, jqXHR){
							if (response == "1") { 
								$("#login_message").html('Login successful. Redirecting...');
								$("#form_login").submit();
							} else if (response == "2") {
								$("#login_message").html('Unable to login. Account has been deactivated.'); 
								$("#button_login").removeAttr('disabled');
							} else {
								$("#login_message").html('Unable to login. Username / Password did not match.'); 
								$("#button_login").removeAttr('disabled');
							}
						},
						error: function(jqXHR, textStatus, errorThrown){
							displayNotification("error", "Oops, something went wrong. Your action may or may not have been completed.");
						}
					});
				}
			}
			</script>
		<?php } ?>		
		</div>
	</body>
</html>