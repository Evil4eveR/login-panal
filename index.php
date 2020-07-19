<?php

require_once( './inc/connect.php' );
require_once( './ClassPHP/_init.php');

?>

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<meta http-equiv = 'X-UA-Compatible' content = 'ie=edge'>
<meta name = 'Description' content = 'Enter your description here'/>
<link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
<link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css'>
<link rel = 'stylesheet' href = 'template/style.css'>
<link href = 'css/style.css' rel = 'stylesheet'>
<title>login-panal</title>
</head>
<body style = 'background-image: url(./template/img/back.jpg)'>

<div class = 'row'>
    <div class="col-sm-3 col-md-6 col-lg-4 form-container">
        <form method="POST" class = 'form-login' action = '<?=$_SERVER['PHP_SELF']?>'>
            <div class = 'form-group'>
                <h3><span class ='label label-default'>login</span></h3>
                <?php
                
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                // username and password sent from form 
                
                $myusername = mysqli_real_escape_string($conn,$_POST['username']);
                $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
                
                $sql= "SELECT * FROM users WHERE username = '$myusername' AND password = '$mypassword' ";
                    $result = mysqli_query($conn,$sql);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($conn));
                        exit();
                    }
                    $check = mysqli_fetch_array($result);
                    if(isset($check)){
                        $_SESSION['login_user'] = $myusername;
                        
                        header("location: welcome.php");
                    }else {
                        echo"<h5 class='alert alert-danger'>Your Login Name or Password is invalid</h5>";
                        }
                }
                ?>
            </div>
            <div class = 'form-group'>
                <label for = 'username'><span class = 'label label-default'>USERNAME</span></label>
                <input type = 'text' class = 'form-control' name = 'username' id = 'username' aria-describedby = 'helpUsername' placeholder = 'username' value="<?= $myusername ?? "" ?>">
                <small id = 'helpUsername' class = 'form-text text-muted'>Help text</small>
            </div>
            <div class = 'form-group'>
                <label  for = 'password'><span class = 'label label-default'>PASSWORD</span></label>
                <input type = 'password'

                class = 'form-control' name = 'password' id = 'password' aria-describedby = 'helpPassword' placeholder = '********'>
                <small id = 'helpPassword' class = 'form-text text-muted'>Help text</small>
            </div>
            <div class = 'form-group'>
                <input class = 'btn btn-success btn-block' value = 'Login' type = 'submit'>
            </div>
        </form>
    </div>
    <div class="col-sm-9 col-md-6 col-lg-8">
        <h1>MIRROR | GNIDOC</h1>
        <h2>YOU LOVE CODING, YOU LOVE THE TRICKING CODES.
        JOIN US and Get YOUR FIRST STEP TO SHARE AND GET
        OTHERS CODE AND IDEA. HAVE FUN</h2>
        </>
    </div>
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; <a href="https://people.inf.elte.hu/nwyuk6/">YASSIN MARMOUD</a> </small>
    </div>
  </footer>
</div>
<script src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js'></script>
<script src = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js'></script>
<script src = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js'></script>
</body>
</html>