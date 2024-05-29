<?php
echo '<h1>Your Friends</h1><br>';
session_start();
if (file_exists('partials/db_connect.php')) {
    include 'partials/db_connect.php';
} else {
    die("file not found.");
}

$email = $_SESSION['email'];

$userloginid = "SELECT UserID FROM user_details WHERE email = '$email'";
$result = mysqli_query($link, $userloginid);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userloginidnow = $row['UserID'];
} else {
    die("Currently Noting is found from retrieve UserID .");
}

$useridfriends = "SELECT * FROM fr_user WHERE UserID = '$userloginidnow'";
$result = mysqli_query($link, $useridfriends);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userfriends = $row['userfriends'];

    $friend = explode(',', $userfriends);
    foreach ($friend as $frienduser_id) {
        $frienduser_id = trim($frienduser_id);

        $friendmail = "SELECT * FROM user_details WHERE UserID = '$frienduser_id'";
        $friendmail_run = mysqli_query($link, $friendmail);

        if ($friendmail_run && mysqli_num_rows($friendmail_run) > 0) {
            $fetchemail = mysqli_fetch_assoc($friendmail_run);
            $FriendsEmail = $fetchemail['email'];
            echo 'Friend Emailaddress: ' . $FriendsEmail . '<br>';
        } else {
            echo 'Nothing is found' .  '<br>';
        }
    }
} else {
    echo "Currently Nothing is found.";
}

mysqli_close($link);
