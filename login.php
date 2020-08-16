<?php

session_start();
require_once "config.php";

$ShowForm = TRUE;
$errorCount = 0;
$Username = "";
$Password = "";
$Username_Err = "";
$Password_Err = "";
$Credentials_Err = "";


function validateInput($data){
    if( empty( trim($data) ) ){ //if $data field is empty (no input from user) display error
        $retval = "";
    }
    else{ //if it isn't empty, clean up input
        $retval = trim($data);
        $retval = stripslashes($retval);
    }
    return($retval);
}


if(isset($_POST["submit"])){

    if(empty( trim($_POST['username']) )){
        $Username_Err = "Required Field";
        ++$errorCount;
    }
    else{
        $Username = validateInput($_POST['username']);
    }
    if(empty( trim($_POST['password']) )){
        $Username_Err = "Required Field";
        ++$errorCount;
    }
    else{
        $Password = validateInput($_POST['password']);
    }

    //Validating credentials
    $SQLstring = "SELECT * FROM Alarcon_Pedro_users WHERE Username='$Username' and password='$Password'";
    $QueryResult = mysqli_query($DBConnect, $SQLstring);
    if(mysqli_num_rows($QueryResult) == 0){
        $Credentials_Err = "Invalid Username and/or Password";
        ++$errorCount;
    }
    if($errorCount == 0){
        if ($QueryResult == FALSE) {
            echo "<p>Unable to execute query</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
        } else {
            session_start();

            $SQLstring = "SELECT Email FROM Alarcon_Pedro_users WHERE Username='$Username' and password='$Password'";
            $QueryResult = mysqli_query($DBConnect, $SQLstring);
            while($row = mysqli_fetch_array($QueryResult)) {
                $_SESSION["email"] = $row['Email'];
            }

            $_SESSION["username"] = $Username;
            $_SESSION["password"] = $Password;
            $_SESSION["isLoggedIn"] = true;
            header("location: homepage.php");
        }
    }


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

        .error {
            color: #FF0000;
            font-size: small;
        }

    </style>
</head>
<body>

<div class="container">

    <div style="text-align: left"><h1>Login Page</h1></div>
    <span class="error"> <?php echo $Credentials_Err;?></span><br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <label for="username">Username</label><br>
        <input type="text" name="username">
        <span class="error"> <?php echo $Username_Err;?></span><br>

        <label for="password">Password</label><br>
        <input type="text" name="password">
        <span class="error"> <?php echo $Password_Err;?></span><br>

        <input type="submit" name="submit" value="Submit"/><br /><br>

        <p>Don't have an account? <a href="register.php">Sign Up Now</a></p>
    </form>




</div>

</body>
</html>