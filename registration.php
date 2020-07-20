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
				$phone = $_POST['phone'];
				$addr = $_POST['address'];
				$bio = $_POST['bio'];
				$nat = $_POST['nationality'];

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
				if (empty($phone)) {
					$errors[] = "number phone is required";
				}
				if (empty($addr)) {
					$errors[] = "address is required";
				}
				if (empty($bio)) {
					$errors[] = "bio is required";
				}
				if (empty($nat)) {
					$errors[] = "nationality is required";
				}

				if (!empty($errors)) {
					foreach ($errors as $err) {
						echo"<h5 class='alert alert-danger'>$err</h5>";
					}
				} else {
					$sql = "INSERT INTO users (username, email, password, phone, address, bio, nat) VALUES ('$username', '$email', '$pass1', '$phone', '$addr', '$bio', '$nat')";
					if ($conn->query($sql) === TRUE) {
						register_session($username);
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
			?>
			<!-- step 1 starting -->
			<div class="form-group group-1">
				<label for="username"><span class="label label-default">USERNAME</span></label>
				<input type="text" autofocus class="form-control" name="username" id="username" aria-describedby="helpNname" placeholder="username" value="<?= $username; ?>">
				<small id="helpName" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group group-1">
				<label for="mail"><span class="label label-default">Email</span></label>
				<input type="text"
					class="form-control" name="mail" id="mail" aria-describedby="helpMail" placeholder="example@example.fr" value="<?= $email; ?>">
				<small id="helpMail" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group group-1">
				<label  for="pass1"><span class="label label-default">password</span></label>
				<input type="password"
					class="form-control" name="pass1" id="pass1" aria-describedby="helpPass1" placeholder="********">
				<small id="helpPass1" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group group-1">
				<label  for="pass2"><span class="label label-default">confirm password</span></label>
					<input type="password"
						class="form-control" name="pass2" id="pass2" aria-describedby="helpPass2" placeholder="********">
				<small id="helpPass2" class="form-text text-muted">Help text</small>
			</div>

			<div class="form-group">
				<button type="button" class="btn btn-primary btn-block" id="group-1">step 2</button>
			</div>
			<!-- step 1 ending -->

			<!-- step 1 starting -->
			<div class="form-group group-2">
				<label  for="phone"><span class="label label-default">phone number</span></label>
					<input type="number" class="form-control" name="phone" id="phone" aria-describedby="helpPhone" placeholder="phone number">
				<small id="helpPhone" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group group-2">
				<label  for="address"><span class="label label-default">address</span></label>
					<input type="text" class="form-control" name="address" id="address" aria-describedby="helpAddr" placeholder="your address">
				<small id="helpAddr" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group group-2">
				<label  for="nationality"><span class="label label-default">nationality</span></label>
					<input type="text" class="form-control" name="nationality" id="nationality" aria-describedby="helpNat" placeholder="your nationality">
				<small id="helpNat" class="form-text text-muted">Help text</small>
			</div>
			<div class="form-group group-2">
				<label  for="bio"><span class="label label-default">about yourself</span></label>
					<textarea name="bio" class="form-control" id="bio" rows="5" id="bio" aria-describedby="helpBio" placeholder="tell us something about yourself"></textarea>
				<small id="helpBio" class="form-text text-muted">Help text</small>
			</div>

			<div class="form-group">
				<button type="button" class="btn btn-primary btn-block" id="group-2">step 3</button>
			</div>
			<!-- step 1 ending -->

			<!-- final step & submit -->
			<div class="form-group group-3">
				<p class="h4">l have read &amp; accept the terms</p>
			</div>
			<div class="form-group">
				<input class="btn btn-success btn-block" value="Registration" type="submit">
			</div>
			<!-- final step & submit -->
		</form>
	</div>
</div>

<?php require_once( './partials/footer.php' ); ?>
<script src="./template/main.js"></script>