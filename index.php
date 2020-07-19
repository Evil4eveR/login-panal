<?php

require_once( './inc/connect.php' );
require_once( './ClassPHP/_init.php' );

if (isset($_SESSION['login_user'])) {
	redirect_to_home();
}


$title = "login";

require_once( './partials/head.php' );
?>

<body style = 'background-image: url(./template/img/back.jpg)'>

<div class = 'row'>
<div class = 'col-sm-12 col-md-4 form-container'>
<form method = 'POST' class = 'form-login' action="<?=$_SERVER['PHP_SELF']?>">
<div class = 'form-group'>
<h3><span class = 'label label-default'>login</span></h3>
<?php

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    // username and password sent from form

    $myusername = mysqli_real_escape_string( $conn, $_POST['username'] );
    $mypassword = mysqli_real_escape_string( $conn, $_POST['password'] );

    $sql = "SELECT * FROM users WHERE username = '$myusername' AND password = '$mypassword' ";
    $result = mysqli_query( $conn, $sql );
    if ( !$result ) {
        printf( 'Error: %s\n', mysqli_error( $conn ) );
        exit();
    }
    $check = mysqli_fetch_array( $result );
    if ( isset( $check ) ) {
			register_session($myusername);
    } else {
        echo"<h5 class='alert alert-danger'>Your Login Name or Password is invalid</h5>";
    }
}
?>
</div>
<div class = 'form-group'>
<label for = 'username'><span class = 'label label-default'>USERNAME</span></label>
<input type = 'text' class = 'form-control' name = 'username' id = 'username' aria-describedby = 'helpUsername' placeholder = 'username' autofocus>
<small id = 'helpUsername' class = 'form-text text-muted'>Help text</small>
</div>
<div class = 'form-group'>
<label  for = 'password'><span class = 'label label-default'>PASSWORD</span></label>
<input type = 'password' class = 'form-control' name = 'password' id = 'password' aria-describedby = 'helpPassword' placeholder = '********'>
<small id = 'helpPassword' class = 'form-text text-muted'>Help text</small>
</div>
<div class = 'form-group'>
<input class = 'btn btn-success btn-block' value = 'Login' type = 'submit'>
</div>
</form>

</div>
</div>

<?php require_once( './partials/footer.php' ); ?>