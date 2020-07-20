<?php

require_once( './inc/connect.php' );
require_once( './ClassPHP/_init.php' );

if (! isset($_SESSION['login_user'])) {
	redirect_to_home();
}
else{
  $USER=$_SESSION['login_user'];
}
$title = "home";

require_once( './partials/head.php' );
?>
<body style = 'background-image: url(./template/img/back.jpg)'>
<nav class="navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="Welcome.php">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php if(is_admin($USER)):?>
          <li class="nav-item">
            <a class="nav-link" href="#" id="getUsers">Users <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="col-sm-10 col-md-1 form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search">
        </form>
          <?php endif;?>
        
        <a id="logout" href="./logout.php" class="btn btn-danger" type="logout">logout</a>
      </div>
    </nav>

</div>
<div class="row alert alert-success">
  <div class="col-xs-6">
  <img src="./template/img/User.jpg" alt="USER">
  </div>
  <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
    <h1>Welcome (<?=$USER?>)</h1>
    <span class="badge badge-dark"><?=date("M,d,Y h:i:s A")?></span>
  </div>   
</div>
<div>
<div class="aler aler-primary">
<?php 

$sql = "SELECT * FROM users WHERE is_admin=0";
$result = $conn->query($sql);
if(isset($_GET) && !empty($_GET)){
  $id=$_GET['id'];
  $Delsql = "DELETE FROM users WHERE id = $id";
  if (mysqli_query($conn, $Delsql)) {
    mysqli_close($conn);
    header('Location: welcome.php');
    exit;
  } else {
    echo "<h5 class='alert alert-danger'>Error deleting record</h5>";
  }
}
if ($result->num_rows > 0) {
  // output data of each row
  echo '<ul class="list-group">';
  while($row = $result->fetch_assoc()) { ?>
    <li id="<?= $row['id']; ?>" class="list-group-item d-flex justify-content-between align-items-center">
      <div>
      @<?= $row['username']; ?>
      <br>
      <?= $row['email']; ?>
      </div>
      <span class="badge badge-secondary badge-pill"><a class="text-white" href="welcome.php?id=<?=$row['id']?>">delete</a></span>
    </li>
  <?php }
  echo '</ul>';
} else {
  echo "<h5>no results, no user registred!</h5>";
}
?>
</div>
<?php require_once('./partials/footer.php')?>
<script>
    $('.list-group').hide();
  $('#getUsers').on('click', function() {
    $('.list-group').show();
  });
</script>