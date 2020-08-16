<?php
include 'header.html';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<body>

<div style="text-align: center"><h1>Welcome</h1></div>

</body>
</head>
</html>

<?php include 'footer.php'; ?>
