<?php
// Check login status
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

echo '<h1>Status Login</h1>';
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    echo "<p style='color: green;'>Status: LOGGED IN as " . ($_SESSION['admin_name'] ?? $_SESSION['admin_username']) . "</p>";
    echo "<p><a href='force_logout.php'>Log Out Now</a></p>";
    echo "<p><a href='index.php'>Go to Dashboard</a></p>";
} else {
    echo "<p style='color: red;'>Status: NOT LOGGED IN</p>";
    echo "<p><a href='simple_login.php'>Go to Login Page</a></p>";
}
?>
