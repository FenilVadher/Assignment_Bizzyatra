<?php
echo "<h2>Got Friend Request from your friend</h2><br>";
session_start();
if (file_exists('partials/db_connect.php')) {
    include 'partials/db_connect.php';
} else {
    die("file not found.");
}

$email = $_SESSION['email'];

$userloginid = "SELECT UserID FROM user_details WHERE email = '$email'";
$result = mysqli_query($link, $userloginid);

$userloginidnow = null; // Initialize the variable
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userloginidnow = $row['UserID'];
}

if ($userloginidnow !== null) { // Check if $userloginidnow is not null before proceeding
    $getuserid_featch = "SELECT RecievedFriendrequest FROM fr_user WHERE UserID = '$userloginidnow'";
    $result = mysqli_query($link, $getuserid_featch);
    if ($result) {
        while ($get_userid_fr = mysqli_fetch_assoc($result)) {
            $allReceivedUID = $get_userid_fr['RecievedFriendrequest'];
            $num = explode(" ", $allReceivedUID);

            foreach ($num as $number) {
                $number = trim($number);
                if (!empty($number)) {
                    $email_recieve = "SELECT email FROM user_details WHERE UserID = '$number'";
                    $email_recieve_run = mysqli_query($link, $email_recieve);
                    if ($email_recieve_run && mysqli_num_rows($email_recieve_run) > 0) {
                        while ($row = mysqli_fetch_assoc($email_recieve_run)) {
?>
                            <div class="table-container">
                                <table class="friend-request-table">
                                    <link rel="stylesheet" type="text/css" href="recieve.css">
                                    <tr>
                                        <th>RecievedFriendrequest</th>
                                        <th>Accept Friend request</th>
                                        <th>Reject Friend request</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <form action="ac-rj-fr.php" method="POST">
                                                <input type="hidden" name="getmail" value="<?php echo $row['email']; ?>">
                                                <input type="hidden" name="getuserid" value="<?php echo $number; ?>">
                                                <input type="hidden" name="useridnow" value="<?php echo $userloginidnow; ?>">
                                                <button name="Accept" type="submit">Accept Friend request</button>
                                                <button name="reject" type="submit">Reject Friend request</button>
                                            </form>
                                            <!-- <form action="ac-rj-fr.php" method="POST">
                                                <button name="reject" type="submit">Reject Friend request</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                </table>
                            </div>
<?php
                        }
                    }
                }
            }
        }
    }
}

?>