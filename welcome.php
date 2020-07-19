<?php

require_once( './inc/connect.php' );
require_once( './ClassPHP/_init.php' );

$title = "register";

require_once( './partials/head.php' );
?>

<h3 class="text-center mt-2 mb-4">welcome <?= $_SESSION['login_user'] ?> </h3>

<a class="btn btn-danger" href="./logout.php">logout</a>

<?php require_once( './partials/footer.php' ); ?>
