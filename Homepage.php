<?php
// Homepage.php
if (file_exists('partials/nav.php')) {
    include 'partials/nav.php';
    echo 'Please login to your account in the chat app via email verification.';
} else {
    echo "file not found.";
}
