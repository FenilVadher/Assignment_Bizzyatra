<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $loggedin = true;
} else {
  $loggedin = false;
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chatapp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="navbar.css">

</head>

<body>

  <nav class="navbar navbar-expand-lg" style="background-color:slateblue;">
    <div class="container-fluid" id="nav">
      <a class="navbar-brand" style=" color: white;">Chatapp</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent" id="navul">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navul">
          <?php
          if ($loggedin) {
            echo '
        <li class="nav-item"  >
          <a id="navitem" class="nav-link active" aria-current="page" href="Userhomepage.php">Home</a>
        </li>
        ';
            echo '
        <li class="nav-item" >
          <a id="navitem" class="nav-link" href="logout.php">Logout</a>
        </li>';
          }

          if (!$loggedin) {
            echo '
        <li class="nav-item" >
          <a id="navitem" class="nav-link active" aria-current="page" href="Homepage.php">Home</a>
        </li>
        ';
            echo '
        <li class="nav-item">
          <a   id="navitem"class="nav-link" href="Userloginpage.php">Login</a>
        </li>';
          }

          ?>

        </ul>


      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>