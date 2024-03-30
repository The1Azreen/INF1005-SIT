<?php
    session_start(); // Start the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect the user to the index page or any other desired page after logout
    header("Location: index.php");
?>
