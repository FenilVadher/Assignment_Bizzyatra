<?php
  include 'partials/nav.php';
?>

<?php

if(isset($_POST['register'])){
  include 'partials/db_connect.php';
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $cpass = $_POST['confirm_password'];
  $existsql = "SELECT * FROM `user_details` WHERE email='$email'";
  $result = mysqli_query($link, $existsql);
  $numExistrows = mysqli_num_rows($result);

  if($numExistrows > 0){
    echo '
    <div class="alert alert-secondary alert-dismissible fade show" role="alert" Style="margin-top:5px;">
      <strong> Password do not match or username already Exist!"</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
  } else {
    if($pass == $cpass){
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `user_details` (`email`, `password`) VALUES ('$email', '$hash')";
      $result = mysqli_query($link, $sql);
      if($result){
        echo '
      <div class="alert alert-secondary alert-dismissible fade show" role="alert" Style="margin-top:5px;">
        <strong> Your Account has been created successfully you can login now!"</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';
      } 
    } else {
      echo '
      <div class="alert alert-secondary alert-dismissible fade show" role="alert" Style="margin-top:5px;">
        <strong> Password do not match or username already Exist!"</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';
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
  <body >
<div class="container" style="margin-top: 120px; width:550px; ">
<form class="my-5" id="signupform" action="Usersignuppage.php" method="POST">
<div class="mb-3">
    <h3 style="text-align:center;"  >SignUp</h3>
    <br>

  </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3">
      <label for="confirmpassword" class="form-label">Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control" id="confirmpassword">
      <div id="emailHelp" class="form-text">Make sure you enter same password</div>

      </div>
    <div class="d-flex justify-content-center">
    <button type="submit" name="register" class="btn btn-primary" >Register</button>
    </div>

  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
';
?>

<?php
