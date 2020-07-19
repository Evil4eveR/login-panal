<?php

$BASE_DIR = realpath(__DIR__ . "/..");

session_start();
require_once("utils.php");
require_once("storage.php");

/*$sql = "select * from users;";
$permission = $conn->prepare($sql);
$permission->execute();
$permission = $permission->fetchAll();
//$users_store = new JSONStorage("${BASE_DIR}/data/data.json");
*/
$errors = [];

function register_session ($val) {
	$_SESSION['login_user'] = $val;

	header( 'location: welcome.php' );
}

function redirect_to_home() {
	header( 'location: welcome.php' );
}