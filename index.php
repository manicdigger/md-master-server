<?php
$loggedIn = false;
$username = null;

session_start();
if(isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
	$loggedIn = true;
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
	<title>Manic Digger</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6"><img src="img/header.png" /></div>
			<div class="col-md-6">
				<div class="login-box">
					<div id="logged-out" class="<?php if($loggedIn) { echo "hide"; }?>">
						<form id="login" action="loginuser.php" method="post" class="form-inline login-form">
							<div>
								<input name="username" type="text" class="form-control" placeholder="Username" />
								<input name="password" type="password" class="form-control" placeholder="Password" />
								<div class="checkbox">
								<label>
									<input name="rememberme" type="checkbox" /> Remember me
								</label>
								</div>
							</div>
							<p>
							<div>
								<button type="submit" name="submit" class="btn btn-primary">Sign in</button>
								<a data-target="#create-account-modal" role="button" class="btn btn-default btn-sm" data-toggle="modal">Create Account</a>
							</div>
						</form>
					</div>
					<div id="logged-in" class="<?php if(!$loggedIn) { echo "hide"; }?>">
						Logged in as <span id="username-text"><?php echo $username ?></span> 
						<span class="pull-right">
							<a href="#update-account-modal" data-toggle="modal">Update Account</a> | 
							<a id="logout-link" href="logoutuser.php">Logout</a>
						</span>
					</div>
				</div>
				
				<div id="create-account-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-create" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<form id="create-account" class="form-horizontal">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3 id="modal-create">Create Account</h3>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="inputEmail" class="col-md-3">Username</label>
										<div class="col-md-6">
											<input class="form-control" type="text" name="username" id="create-username" tabindex="30" placeholder="Username" required><span class="help-inline"><span id="username-check" class="hide label"></span></span>
										</div>
									</div>
									<div class="form-group">
										<label for="create-password" class="col-md-3">Password</label>
										<div class="col-md-6">
											<input class="form-control" type="password" name="password" id="create-password" tabindex="31" placeholder="Password" required>
										</div>
										<div class="col-md-2">
											<span class="help-inline"><span id="password-check" class="hide label"></span></span>
										</div>
										<div class="col-md-offset-3 col-md-6">
											<input class="form-control" type="password" name="passwordagain" id="create-password-again" tabindex="32" placeholder="Password Again" required>
										</div>
										<div class="col-md-2">
											<span class="help-inline"><span id="password-match" class="hide label"></span></span>
										</div>
									</div>
									<div class="form-group">
										<label for="create-email" class="col-md-3">Email</label>
										<div class="col-md-6">
											<input class="form-control" type="text" name="email" id="create-email" tabindex="33" placeholder="Email (optional)">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button tabindex="40" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
									<button tabindex="35" class="btn btn-primary" type="submit">Create Account</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				
				<form id="update-account" class="form-horizontal">
					<div id="update-account-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-update" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 id="modal-update">Update Account</h3>
						</div>
						<div class="modal-body">
							<div class="control-group">
								<label class="control-label" for="update-password">Password</label>
								<div class="controls">
									<input type="password" name="password" id="update-password" tabindex="31" placeholder="Password" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="update-password">New Password</label>
								<div class="controls">
									<input type="password" name="newpassword" id="update-new-password" tabindex="31" placeholder="Password (Only if new)"><span class="help-inline"><span id="update-password-check" class="hide label"></span></span>
									<input type="password" name="newpasswordagain" id="update-new-password-again" tabindex="32" placeholder="Password Again (Only if new)"><span class="help-inline"><span id="update-password-match" class="hide label"></span></span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="update-email">Email</label>
								<div class="controls">
									<input type="text" name="email" id="update-email" tabindex="33" placeholder="Email (optional)">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button tabindex="40" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
							<button tabindex="35" class="btn btn-primary" type="submit">Update Account</button>
						</div>
					</div>
				</form>
				
				<!--This height needs to be slightly less than the header.png-->
				<div style="position:relative; height:130px;">
					<div style="position:absolute;right:0;bottom:0">
						<a href="" id="refresh-servers" class="btn btn-info">Refresh Servers</a>
					</div>
				</div>
			</div>
		</div>
		<span id="server-container">
<?php include 'servers.php' ?>
		</span>
	</div>
	<div class="wait"></div>
	<script src="js/jquery-1-11-1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>