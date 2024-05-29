<?php

if (file_exists('partials/nav.php')) {
  include 'partials/nav.php';
} else {
  echo "Navigation file not found.";
}

?>

<?php

if (isset($_POST['register'])) {

  if (file_exists('partials/db_connect.php')) {
    include 'partials/db_connect.php';
  } else {
    echo "connection file not found.";
  }
  $email = ($_POST['email']);
  $pass = ($_POST['password']);
  $cpass = ($_POST['confirm_password']);

  $existsql = "SELECT * FROM user_details WHERE email='$email'";
  $result = mysqli_query($link, $existsql);
  $numExistRows = mysqli_num_rows($result);

  if ($numExistRows > 0) {
    echo '
    <div class="alert alert-secondary alert-dismissible fade show" role="alert" style="margin-top:5px;">
      <strong>Email already exists!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else {
    if ($pass == $cpass) {
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $_SESSION['email'] = $email;

      $random_num = rand(1000, 9999);
      $verification = password_hash($random_num, PASSWORD_DEFAULT);

      $sql = "INSERT INTO user_details (verification, email, password) VALUES ('$verification', '$email', '$hash')";

      $result = mysqli_query($link, $sql);
      
      $insert_fr = "INSERT INTO fr_user (UserID) VALUES ('')";
      
      $insert_fr_run = mysqli_query($link, $insert_fr);
      if( $insert_fr_run ){
        echo "creaated";
      }
      if ($result) {
        $to = $email;
        $subject = 'E-mail verification';
        $f2 = "http://localhost/Bizzyatra_Assignment/Assignment_Bizzyatra/Userloginpage.php?token=$verification";

        echo $f2;
        $message = "
        <html>
        <head>
          <title>E-mail verification</title>
        </head>
        <body>
          <p>Your account has been created. You can log in now by clicking on this link:</p>
          <a href='$f2'>Verify your email address</a>
         
        </body>
        </html>";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "From: fenilvadher0503@gmail.com\r\n";

        $mail = mail($to, $subject, $message, $headers);

        if ($mail) {
          echo 'Email sent successfully.';
        } else {
          echo 'Email sending failed.';
        }
      }

      header('Location:verify.php');
      exit();
    } else {
      echo '
      <div class="alert alert-secondary alert-dismissible fade show" role="alert" style="margin-top:5px;">
        <strong>Passwords do not match!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="signup.css">
</head>

<body>
  <div class="container" id="maindiv">

    <div class="container" id="left">

      <form class="my-5" id="signupform" action="Usersignuppage.php" method="POST">
        <div class="mb-3">
          <h3 style="text-align:center;">Signup for chatapp</h3>
          <br>
        </div>
        <div class="mb-3">
          <label for="InputEmail" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
          <label for="confirmpassword" class="form-label">Confirm Password</label>
          <input type="password" name="confirm_password" class="form-control" id="confirmpassword" required>
          <div id="emailHelp" class="form-text">Make sure you enter the same password</div>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" name="register" class="btn" id="regbtn" style="background-color:#987070">Register</button>
        </div>
      </form>
    </div>
    <div class="container" id="right">


    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>