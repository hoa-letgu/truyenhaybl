<?php
session_start();


$pass = 'Nghia@0307';

// Check if the password is correct
if (!isset($_SESSION['pass']) || $_SESSION['pass'] !== $pass) {
    // Get the password from the get request
    $password_input = isset($_GET['pass']) ? $_GET['pass'] : '';

    // Check if the password is correct
    if ($password_input === $pass) {
        $_SESSION['pass'] = $password_input;
    }

    // If the password is not correct, show the login form
    else {
        echo '<form method="get">
            <input type="password" name="pass" />
            <input type="submit" value="Login" />
        </form>';
        exit;
    }
}  




