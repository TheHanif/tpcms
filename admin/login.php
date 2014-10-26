<?php 
	require_once 'include/init.php';
	require_once 'classes/class.user.php';

	// Check if logout requested by user
	if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
		User::logout();
	}

	// Redirect to dashboard if user is already logged in.
	if (User::is_logged_in(false) === true) {
		header('Location:index.php');
	}

	// Condition if form is submited
	if (isset($_POST['user_name']) && isset($_POST['user_pass'])) {
		
		$ob_user = new User;

		if ($ob_user->do_login($_POST)) {

			//Success, Goto dashboard!
			header('Location:index.php');
		}

		// Faild, Display error message!
		$error = true;
	}



?>
<!DOCTYPE html>
<html class='<?php echo $language->type(); ?>'>
<head>
	<meta charset="UTF-8">
	<title><?php echo $language->filter('Login'); ?></title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<div class="container">
		<div class="form-container clearfix" id="form-container">
			<?php if (isset($error)) {
				echo '<div class="alert alert-danger" role="alert">Invalid username or password.</div>';
			} ?>
			<form role="form" method="post">
			  <div class="form-group">
			    <label for="user_name"><?php echo $language->filter('User name'); ?></label>
			    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="">
			  </div>
			  <div class="form-group">
			    <label for="user_pass"><?php echo $language->filter('User password'); ?></label>
			    <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="">
			  </div>
			  <a href="#" class="btn btn-link pull-left"><?php echo $language->filter('Forgot password?'); ?></a>
			  <button type="submit" class="btn btn-primary pull-right"><?php echo $language->filter('Login'); ?></button>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#form-container').css({marginTop: ($(document).height()-$('#form-container').height())/2});
	});
</script>
</html>