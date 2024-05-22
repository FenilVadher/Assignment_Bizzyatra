<?php
require 'partials/nav.php';

?>

<?php
 $_SESSION['loggedin']=false;
if(isset($_POST['login'])){

    include 'partials/db_connect.php';

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql="SELECT * FROM `user_details` WHERE email='$email'";
    
    $result = mysqli_query($link,$sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($pass,$row['password'])){
                $login= true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['email']=$email;
                echo "done";
                header('location:Userhomepage.php');
            }
        }
      
    }
}


echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    </head>
  <body>
<div class="container" style="margin-top: 100px;  width:550px;" >
  <form class="my-5" id="loginform" action="Userloginpage.php" method="POST">
  <div class="mb-3">
    <h3 style="text-align:center;" >Login Page</h3>
    <br>

  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1"  class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  
<div class="mb-4">
<label for="signup" class="form-label" >New User?</label>
<a href="Usersignuppage.php" id="signup" name="signup" class="alert-link">Signup</a>
</div>
<div class="d-flex justify-content-center">
<button type="submit" name="login" class="btn btn-primary">Login</button>

</div>

</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
';


?>