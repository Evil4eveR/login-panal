<?php

require_once( './inc/connect.php' );
require_once( './ClassPHP/_init.php' );

if (isset($_SESSION['login_user'])) {
	redirect_to_login();
}


$title = "login";

require_once( './partials/head.php' );
?>

<body style = 'background-image: url(./template/img/back.jpg)'>

<div class = 'row'>
    <div class="col-sm-12 col-md-4 form-container">
    <form method="POST" class = 'form-login' action ="<?=$_SERVER['PHP_SELF']?>">
    
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
                <input type = 'password' class = 'form-control' name = 'password' id = 'password' aria-describedby = 'helpUsername' placeholder = 'password'>
                <small id = 'helpUsername' class = 'form-text text-muted'>Help text</small>
    </div>
            <div class = 'form-group'>
                <input class = 'btn btn-success btn-block' value = 'Login' type = 'submit'>
            </div>
            <div class = 'form-group'>
                
            <h5><span class ='label label-default'>Register Now</span></h5>
            </div>
            <div class = 'form-group'>
               <span class='btn btn-primary btn-block'><a href="registration.php" class="text-white">sign up</a></span>
            </div>
    </form>
    </div>
    <div class="col-sm-12 col-md-7">
        <div>
            <h1 id="titleh">MIRROR | GNIDOC</h1>
        <div class="row">
        <div class="col-sm-12 col-md-4">
        <h2 class='text'>YOU LOVE CODING, YOU LOVE THE TRICKING CODES.
            JOIN US AND Get YOUR FIRST STEP TO CODE UP.
            SHARE AND GET OTHERS CODE AND IDEA. HAVE FUN
        <h2>
        </div>
        <div class="col-sm-12 col-md-8">
         <img class="image" style="width:500px; hieght:500px" src="./template/img/code.jpg" alt="coding">    
        </div>
        </div>
        </div>
       </div>
</div>
<?php require_once( './partials/footer.php' ); ?>
