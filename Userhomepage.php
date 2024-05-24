<?php

if (file_exists('partials/nav.php')) {
  include 'partials/nav.php';
} else {
  echo "Navigation file not found.";
}

if ($_SESSION['loggedin'] = true) {
  echo '
    <div class="alert alert-secondary alert-dismissible fade show" role="alert" Style="margin-top:5px;">
      <strong>Welcome!!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}

if (isset($_POST['Delete_Account'])) {

  if (file_exists('partials/db_connect.php')) {
    include 'partials/db_connect.php';
  } else {
    echo "connection file not found.";
  }

  $email = $_SESSION['email'];
  echo $email;
  $sql = "DELETE FROM `user_details` WHERE `email` = '$email'";
  $result = mysqli_query($link, $sql);
  echo "account deleted";
  session_unset();
  session_destroy();
  header("location:Homepage.php");
}
?>


<br><br>
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_account">
  Delete Account
</button>

<div class="modal fade" id="delete_account" tabindex="-1" aria-labelledby="delete_accountLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="delete_accountLabel">Delete Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you confirmed you want to delete your Account???
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="Userhomepage.php" method=POST>
          <button type="submit" name="Delete_Account" class="btn btn-danger">Delete</button>

        </form>

      </div>
    </div>
  </div>
</div>