# secured-login-system
Uses PHP embedded with MySQL for user registration and authentication. Styles built with HTML and CSS.

## Summary

1. Login
2. Registration
3. Welcome
4. Account Details
5. Password Reset
6. Log out


### Login

Login page authenticates user-input credentails against 'users' database. Redirects to welcome page is match found. 

<details>
  <summary>MySQL</summary>
  
  '''mysql
   
    $SQLstring = "SELECT * FROM $Table WHERE Username='$Username' and password='$Password'";
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

            $SQLstring = "SELECT Email FROM $Table WHERE Username='$Username' and password='$Password'";
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
  '''
  
</details>
  

![alt text](images/login.png "Login")


### Registration

![alt text](images/registration.png "Sign Up")

### Welcome

![alt text](images/welcome.png "Welcome Page")

### Account Details



### Password Reset

![alt text](images/reset.png "Password Reset")

