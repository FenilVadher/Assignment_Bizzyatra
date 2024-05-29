<?php

session_start();
if (file_exists('partials/db_connect.php')) {
    include 'partials/db_connect.php';
} else {
    echo "file not found.";
}
$email = $_SESSION['email'];
// echo $email;
$userloginid = "SELECT UserID FROM user_details WHERE email = '$email'";

$result = mysqli_query($link, $userloginid);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userloginidnow = $row['UserID'];
    echo '<h2>Add your Friends</h2>';
    // echo $userloginidnow;
}

$sql = 'SELECT * FROM user_details WHERE email != "' . $_SESSION["email"] . '"';

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
?>
        <table style="border:1px solid black;">
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    border-spacing: 0;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    margin-bottom: 20px;
                }

                th,
                td {
                    padding: 12px;
                    text-align: left;
                }

                th {
                    background-color: #987070;
                    color: white;
                }

                tr:nth-child(even) {
                    background-color: #f8f9fa;
                }

                tr:hover {
                    background-color: #76ABAE;
                }

                button {
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    background-color: #F97300;
                    color: white;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                button:hover {
                    background-color: #6D5D6E;
                }
            </style>
            <tr>
                <th>Users</th>
                <th>Add</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <form method="POST" action="fr-send.php">
                            <input type="hidden" name="emailsendtouser" value="<?php echo $row['email']; ?>">
                            <input type="hidden" name="UserID" value="<?php echo $row['UserID']; ?>">
                            <input type="hidden" name="userloginidnow" value="<?php echo $userloginidnow; ?>">
                            <input type="hidden" name="currentuser" value="<?php echo $_SESSION["email"]; ?>">
                            <button type="submit" name="SendFR">Add Friend</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
<?php
        mysqli_free_result($result);
    } else {
        echo "Nothing is found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


mysqli_close($link);

?>