<?php

/* validateInput() function accepts two string input parameters and validates $data.
   returns the $data parameter after it has been cleaned up. If $data is empty, display error message,
   otherwise, proceed with cleaning procedure. */
function validateInput($data){
    global $errorCount;
    if( empty( trim($data) ) ){ //if $data field is empty (no input from user) display error
        ++$errorCount;
        $retval = "";
    }
    else{ //if it isn't empty, clean up input
        $retval = trim($data);
        $retval = stripslashes($retval);
    }
    return($retval);
}

/*
    Checks whether input email $data is empty, if so display error message, otherwise remove all
    illegal characters from the email. Checks whether email, display a message if not.
 */
function validateEmail($data , $fieldName){
    global $errorCount;

    if( empty($data) ){
        echo "\"$fieldName\" is a required field. <br />\n";
        ++$errorCount;
        $retval = "";
    }
    else{
        $retval = filter_var($data , FILTER_SANITIZE_EMAIL);

        if(!filter_var($retval ,FILTER_VALIDATE_EMAIL) ){
            echo "\"$fieldName\" is not a valid e-mail address.<br />\n";
        }
    }
    return($retval);
}

function validatePassword($data){
    global $errorCount;
    if( empty( trim($data) ) )
    { //if $data field is empty (no input from user) display error
        ++$errorCount;
        $retval = "";
    }
    else { //if it isn't empty, clean up input
        $retval = trim($data);

    }
    return($retval);
}


?>
