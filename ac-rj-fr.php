<?php
session_start();
if (file_exists('partials/db_connect.php')) {
    include 'partials/db_connect.php';
} else {
    die("file not found.");
}

if (isset($_POST['Accept'])) {
    $getmail = $_POST['getmail'];
    $useridnow = $_POST['useridnow'];
    $getuserid = $_POST['getuserid'];

    $sql = "SELECT * FROM fr_user WHERE UserID= '" . $useridnow . "'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            $getfr = $row['RecievedFriendrequest'];

            $deletefromget = str_replace($getuserid, "", $getfr);
            $deletefromget = preg_replace('/\s+/', '', $deletefromget);
            $friends = $row['userfriends'];
            $friendadd = trim($friends . ',' . $getuserid, ',');
            $friendadd = preg_replace('/[^0-9,]/', '', $friendadd);
            $friendupdated = 'UPDATE fr_user SET userfriends = "' . $friendadd . '" WHERE UserID="' . $useridnow . '"';
            $friendupdated_run = mysqli_query($link, $friendupdated);
            $deletefromcurrent = 'UPDATE fr_user SET RecievedFriendrequest = "' . $deletefromget . '" WHERE UserID="' . $useridnow . '"';
            $deletefromcurrent_run = mysqli_query($link, $deletefromcurrent);
            if ($deletefromcurrent_run && $friendupdated_run) {
                echo "Your Friend list added successfully.";
            } else {
                echo "Error is occur form your friend list.";
            }
        }
    } else {
        echo "Nothing is found.";
    }

    $sql = "SELECT * FROM fr_user WHERE UserID= '" . $getuserid . "'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            $sentfr = $row['Sendfriendrequest'];

            $deletefromsent = str_replace($useridnow, "", $sentfr);
            $deletefromsent = preg_replace('/\s+/', '', $deletefromsent);
            $friends = $row['userfriends'];
            $friendadd = trim($friends . ',' . $useridnow, ',');
            $friendadd = preg_replace('/[^0-9,]/', '', $friendadd);
            $friendupdated = 'UPDATE fr_user SET userfriends = "' . $friendadd . '" WHERE UserID="' . $getuserid . '"';
            $friendupdated_run = mysqli_query($link, $friendupdated);
            $deletefromreceived = 'UPDATE fr_user SET Sendfriendrequest = "' . $deletefromsent . '" WHERE UserID="' . $getuserid . '"';
            $deletefromcurrent_run = mysqli_query($link, $deletefromreceived);
            if ($deletefromcurrent_run && $friendupdated_run) {
                echo "Your Friend list added successfully.";
            } else {
                echo "Error is occur form your friend list.";
            }
        }
    } else {
        echo "Nothing is found.";
    }
}
