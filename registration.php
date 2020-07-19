<?php

require_once( './inc/connect.php' );
require_once( './ClassPHP/_init.php' );

if (isset($_SESSION['login_user'])) {
	redirect_to_home();
}

$title = "register";

require_once( './partials/head.php' );

$username = "";
$email = "";

?>

<body style="background-image: url(./template/img/back.jpg)">

<div class="row">
	<div class="col-sm-12 col-md-4 form-container">

		<form class="form-reg" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
			<div class="form-group">
				<h3><span class="label label-default">register</span></h3>
			</div>
			<?php

			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$username = $_POST['username'];
				$email = $_POST['mail'];
				$pass1 = $_POST['pass1'];
				$pass2 = $_POST['pass2'];

				$errors = array();

				$sql = "SELECT * FROM users WHERE email='$email'";
				$result = mysqli_query( $conn, $sql );
				$check = mysqli_fetch_array( $result );

				if (empty($username)) {
					$errors[] = "username is required";
				}
				if (empty($email)) {
					$errors[] = "email is required";
				} else {
					if (! empty($check)) {
						$errors[] = "email already exist";
					}
				}
				if (empty($pass1)) {
					$errors[] = "password is required";
				} else {
					if ($pass1 !== $pass2) {
						$errors[] = "password is not match";
					}
				}

				if (!empty($errors)) {
					foreach ($errors as $err) {
						echo"<h5 class='alert alert-danger'>$err</h5>";
					}
				} else {
					register_session($username);
				}
			}
			?>
			<div class="form-group">
				<label for="username"><span class="label label-default">USERNAME</span></label>
				<input type="text" autofocus class="form-control" name="username" id="username" aria-describedby="helpNname" placeholder="username" value="<?= $username; ?>">
				<small id="helpName" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group">
				<label for="mail"><span class="label label-default">Email</span></label>
				<input type="text"
					class="form-control" name="mail" id="mail" aria-describedby="helpMail" placeholder="example@example.fr" value="<?= $email; ?>">
				<small id="helpMail" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group">
				<label  for="pass1"><span class="label label-default">pass1</span></label>
				<input type="password"
					class="form-control" name="pass1" id="pass1" aria-describedby="helpPass1" placeholder="********">
				<small id="helpPass1" class="form-text text-muted">Help text</small>
			</div>

			<div class="form-group">
				<label  for="pass2"><span class="label label-default">pass1</span></label>
					<input type="password"
						class="form-control" name="pass2" id="pass2" aria-describedby="helpPass2" placeholder="********">
				<small id="helpPass2" class="form-text text-muted">Help text</small>
			</div>

			<div class="form-group">
				<input class="btn btn-success btn-block" value="Registration" type="submit">
			</div>
		</form>
	</div>
</div>

<?php require_once( './partials/footer.php' ); ?>
