<?php

if (file_exists('partials/nav.php')) {
  include 'partials/nav.php';
} else {
  echo "Navigation file not found.";
}

if (file_exists('partials/db_connect.php')) {
  include 'partials/db_connect.php';
} else {
  echo "connection file not found.";
}

if (isset($_GET['token'])) {
  $verification = ($_GET['token']);
  $sql_verify_query = "SELECT email, verification, verified_status, password FROM user_details WHERE verification='$verification' LIMIT 1";
  $sql = mysqli_query($link, $sql_verify_query);

  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_array($sql);
    if ($row['verified_status'] == '0') {

      if (isset($_POST['password']) && isset($_POST['email']) && isset($_POST['verify_token'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if ($email === $row['email']) {
          if (password_verify($pass, $row['password'])) {
            $update_status = "UPDATE user_details SET verified_status='1' WHERE verification='$verification' LIMIT 1";
            $update_status_run = mysqli_query($link, $update_status);
            if ($update_status_run) {
              $_SESSION['loggedin'] = true;
              $_SESSION['email'] = $email;
              header('location:dashboard.php');
              exit();
            }
          } else {
            echo 'Please enter a valid password';
          }
        } else {
          echo 'Please Enter valid Email-id';
        }
      }
    } else {
      echo 'Account is already verified';
    }
  } else {
    echo 'Invalid token';
  }
} else {
  $_SESSION['loggedin'] = false;
  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM `user_details` WHERE email='$email'";
    $result = mysqli_query($link, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['verified_status'] == '1') {
          if (password_verify($pass, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['authenticated'] = 'true';
            header('location:dashboard.php');
            exit();
          } else {
            echo "Invalid password";
          }
        } else {
          echo "Please verify your account";
        }
      }
    } else {
      echo "No user found with this email";
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Verify</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="login.css">

</head>

<body>

  <div class="container" id="maindiv">
    <div class="container" id="left">
      <img src="images/login.avif" alt="">

    </div>
    <div class="container" id="right">
      <form class="my-5" id="loginform" action="" method="POST">
        <div class="mb-3" id="wlcmmsg">
          <h3>Chatapp login</h3>
          <p>Login your account for chatapp</p>

        </div>
        <div class="mb-3">
          <label for="InputEmail" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" id="InputEmail" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
          <label for="InputPassword" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="InputPassword" required>
        </div>

        <?php
        if (isset($_GET['token'])) {
          echo '<input type="hidden" name="verify_token" value="' . htmlspecialchars($_GET['token']) . '">';
        }
        ?>

        <div class="d-flex justify-content-center">
          <button type="submit" id="loginbtn" name="login" style="background-color:#987070" class="btn">Login</button>
        </div>
        <br>
        <div class="mb-4">
          <label for="signup" class="form-label">Don't have account?</label>
          <a href="Usersignuppage.php" id="signup" name="signup" class="alert-link" style="color: #987070;">Sign up</a>
        </div>
      </form>
    </div>

  </div>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>