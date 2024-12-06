<?php
session_start();
include 'conn.php';

// Log user logout activity
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $activityType = 'Logout to the system.';
    $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id', '$activityType')";
    mysqli_query($connection, $logSql);
    
}
// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header("location: index.php");
?>
