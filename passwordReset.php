<?php
include 'header.html';
require_once "validationFunctions.php";

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";


$errorCount = 0;
$Username = "";
$Password = "";
$NewPassword = "";
$ConfNewPassword = "";
$Username_Err = "";
$Password_Err = "";
$NewPassword_Err = "";
$ConfNewPassword_Err = "";
$Credentials_Err = "";


if(isset($_POST["reset"])) {
    if ( empty(trim($_POST['username'])) ) {
        $Username_Err = "Required Field";
        ++$errorCount;
    } else {
        $Username = validateInput($_POST['username']);
    }
    if (empty(trim($_POST['password']))) {
        $Password_Err = "Required Field";
        ++$errorCount;
    } else {
        $Password = validateInput($_POST['password']);
    }
    if (empty(trim($_POST['NewPassword']))) {
        $NewPassword_Err = "Required Field";
        ++$errorCount;
    } else {
        $NewPassword = validateInput($_POST['NewPassword']);
        if( strlen(trim($NewPassword)) < 6 )
        { //if $data field is empty (no input from user) display error
            $NewPassword_Err = "6 characters minimum";
            ++$errorCount;
        }
    }
    if (empty(trim($_POST['ConfNewPassword']))) {
        $ConfNewPassword_Err = "Required Field";
        ++$errorCount;
    } else {
        $ConfNewPassword = validateInput($_POST['ConfNewPassword']);
        $TrimPassword = validateInput($_POST['NewPassword']);
        if( ($ConfNewPassword != $TrimPassword) )
            { //if $data field is empty (no input from user) display error
                $ConfNewPassword_Err = "Password does not match";
                ++$errorCount;
            }

        }


    //Validating credentials
    $ValidatingCredentialsString = "SELECT * FROM Alarcon_Pedro_users WHERE Username='$Username' and Password='$Password'";
    $CredentialsQueryResult = mysqli_query($DBConnect, $ValidatingCredentialsString);
    if (mysqli_num_rows($CredentialsQueryResult) == 0) {
        $Credentials_Err = "Invalid Username and/or Password";
        ++$errorCount;
    }


    if ($errorCount == 0) {

        $UpdatePasswordString = "UPDATE Alarcon_Pedro_users SET Password='$NewPassword' WHERE Username='$Username' ";
        $UpdatePasswordQuery = mysqli_query($DBConnect, $UpdatePasswordString);

        if ($UpdatePasswordQuery == FALSE) {
            echo "<p>Unable to execute query</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
        } else {
            session_destroy();
            header("location: login.php");
            exit();
        }


    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleForm.css">
    <title>Reset Your Password</title>

    <style>
        /* Container box to hold contact form */
        .container {
            background-color: #f2f2f2;
            padding-bottom: 20px;
            padding-left: 35%;
            padding-right: 32%;
        }

        /* Styles the input area, text of input*/
        input[type= text], select, textarea{
            width: 65%; /* text areas occupy full width of contact page*/
            padding: 12px;
            box-sizing: border-box;
            margin-top: 6px; /* adds space on top for label */
            margin-bottom: 20px; /*  adds space on bottom for next text-area input */
        }

        .error {
            color: #FF0000;
            font-size: small;
        }
    </style>
</head>
<body>
<div class="container">
    <div style="text-align: left"><h1>Reset Your Password</h1></div>
    <span class="error"> <?php echo $Credentials_Err;?></span><br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <label for="username">Username</label><br>
        <input type="text" name="username">
        <span class="error"> <?php echo $Username_Err;?></span><br>

        <label for="password">Password</label><br>
        <input type="text" name="password">
        <span class="error"> <?php echo $Password_Err;?></span><br>

        <label for="NewPassword">New Password</label><br>
        <input type="text" name="NewPassword">
        <span class="error"> <?php echo $NewPassword_Err;?></span><br>

        <label for="ConfNewPassword">Confirm New Password</label><br>
        <input type="text" name="ConfNewPassword">
        <span class="error"> <?php echo $ConfNewPassword_Err;?></span><br>

        <input type="submit" name="reset" value="Reset"/><br />

    </form>

</div>
</body>
</html>

<?php include 'footer.php'; ?>