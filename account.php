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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <style>
        *{
            box-sizing:border-box;
        }
        /* Container box to hold contact form */
        .container {
            background-color: #f2f2f2;
            padding-top: 5px;
            padding-bottom: 20px;
            padding-left: 40%;
            padding-right: 40%;
        }
    </style>
</head>
<body>

<div class="container">
    <table border="0">
        <tr>
            <th> </th>
            <th> </th>
        </tr>
        <tr>
            <td>Username: </td>
            <td> <?php echo $_SESSION["username"]?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?php echo $_SESSION["email"]?></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><?php echo $_SESSION["password"]?> </td>
        </tr>
    </table>

</div>



</body>
</html>

<?php include 'footer.php'; ?>
