<?php
// Homepage.php

include 'partials/nav.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to your account in the chat app via email verification.";
} else {
    echo "Please login to your account in the chat app via email verification.";
}
