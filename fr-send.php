<?php
session_start();
if (file_exists('partials/db_connect.php')) {
    include 'partials/db_connect.php';
} else {
    echo "File not found.";
}
// echo "hlo";

if(isset($_POST['SendFR'])) {
    $emailsend = $_POST['emailsendtouser'];
    $UserID = $_POST['UserID'];
    $currentmail = $_POST['currentuser'];
    $userloginidnow = $_POST['userloginidnow'];

    // echo $emailsend.'<br>';
    // echo $UserID.'<br>';
    // echo $currentmail.'<br>';
    // echo $userloginidnow.'<br>';

    $sql = 'SELECT * FROM fr_user WHERE UserID = "' . $UserID . '"';
    $result = mysqli_query($link, $sql);
    if ($result) {
        $newgetnumber = '';
        $newsendnumber = '';

        $pastget = 'SELECT * FROM fr_user WHERE UserID = "' . $UserID . '"';
        $pastget_run = mysqli_query($link, $pastget);
        while ($pastnumber = mysqli_fetch_array($pastget_run)) {
            $pastgeterror = $pastnumber['RecievedFriendrequest'];

            if (strpos($pastnumber['RecievedFriendrequest'], $userloginidnow) === false) {
                $pastnumber['RecievedFriendrequest'] .= " " . $userloginidnow;
            }
            $newgetnumber = $pastnumber['RecievedFriendrequest'];
        }

        $newget = 'UPDATE fr_user SET RecievedFriendrequest = "' . $newgetnumber . '" WHERE UserID="' . $UserID . '"';
        $newget_run = mysqli_query($link, $newget);

        $pastsend = 'SELECT * FROM fr_user WHERE UserID = "' . $userloginidnow . '"';
        $pastsend_run = mysqli_query($link, $pastsend);
        while ($pastnumber = mysqli_fetch_array($pastsend_run)) {
            $pastsenderror = $pastnumber['Sendfriendrequest'];

            if (strpos($pastnumber['Sendfriendrequest'], $UserID) === false) {
                $pastnumber['Sendfriendrequest'] .= " " . $UserID;
            }
            $newsendnumber = $pastnumber['Sendfriendrequest'];
        }

        $newsend = 'UPDATE fr_user SET Sendfriendrequest = "' . $newsendnumber . '" WHERE UserID="' . $userloginidnow . '"';
        $newsend_run = mysqli_query($link, $newsend);
        echo "Friend request has been sent";
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not execute the query. " . mysqli_error($link);
}

?>
