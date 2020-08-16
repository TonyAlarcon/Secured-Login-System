<?php
require_once "config.php";
require_once "validationFunctions.php";


$errorCount = 0;
$Username = "";
$Email = "";
$Password = "";
$ConfPassword = "";
$Username_Err = "";
$Password_Err = "";
$ConfPassword_Err = "";
$Email_Err = "";

if(isset($_POST["submit"])) {
    //validate username
    if ( empty(trim($_POST['username'])) ) {
        $Username_Err = "Required Field";
        ++$errorCount;
    } else {
        $Username = validateInput($_POST['username']);
    }
    //validate email
    if ( empty(trim($_POST['email'])) ) {
        $Email_Err = "Required Field";
        ++$errorCount;
    } else {
        $Email = validateInput($_POST['email']);
        $Email = filter_var($Email , FILTER_SANITIZE_EMAIL);

        if(!filter_var($Email,FILTER_VALIDATE_EMAIL) ){
            $Email_Err = "Invalid Email Address";
            ++$errorCount;
        }
    }
    //validate password
    if (empty(trim($_POST['password']))) {
        $Password_Err = "Required Field";
        ++$errorCount;
    } else {
        $Password = validateInput($_POST['password']);
        if( strlen(trim($Password)) < 6 )
        { //if $data field is empty (no input from user) display error
            $Password_Err = "6 characters minimum";
            ++$errorCount;
        }
    }
    //validate confirm password
    if (empty(trim($_POST['confPassword']))) {
        $ConfPassword_Err = "Required Field";
        ++$errorCount;
    } else {
        $ConfPassword = validateInput($_POST['confPassword']);
        $TrimPassword = validateInput($_POST['password']);
        if( ($ConfPassword != $TrimPassword) )
        { //if $data field is empty (no input from user) display error
            $ConfPassword_Err = "Password does not match";
            ++$errorCount;
        }

    }

    //Checks if Username is taken
    $SQLstring = "SELECT * FROM Alarcon_Pedro_users WHERE Username='$Username'";
    $QueryResult = mysqli_query($DBConnect, $SQLstring);

    if (mysqli_num_rows($QueryResult) > 0) {
        $Username_Err = "Username is taken";
        ++$errorCount;
    }


    if ($errorCount == 0){
        $SQLstring = "INSERT INTO Alarcon_Pedro_users (countID, Email, Username, Password)
            VALUES(NULL, '$Email', '$Username', '$Password')";
        $QueryResult = mysqli_query($DBConnect, $SQLstring);

        if ($QueryResult == FALSE) {
            echo "<p>Unable to execute query</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
        } else {
            header("location: login.php");
        }
    }
    mysqli_close($DBConnect); //close database connection


}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleForm.css">
    <title>Login Page</title>
    <style>
        /* Container box to hold contact form */
        .container {
            background-color: #f2f2f2;
            padding-top: 10%;
            padding-bottom: 20px;
            padding-left: 35%;
            padding-right: 35%;
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
    <div style="text-align: left"><h1>Registration Page</h1></div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <label for="username">Username</label><br>
        <input type="text" name="username">
        <span class="error"> <?php echo $Username_Err;?></span><br>

        <label for="email">E-mail</label><br>
        <input type="text" name="email">
        <span class="error"> <?php echo $Email_Err;?></span><br>

        <label for="password">Password</label><br>
        <input type="text" name="password">
        <span class="error"> <?php echo $Password_Err;?></span><br>

        <label for="confirmPassword">Confirm Password</label><br>
        <input type="text" name="confPassword">
        <span class="error"> <?php echo $ConfPassword_Err;?></span><br>

        <input type="submit" name="submit" value="Submit"/><br />
        <p>Already have an account? <a href="login.php">Login here.</a></p>
    </form>


</div>

</body>
</html>
