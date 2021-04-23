<?php
// Initialize the session
session_start();
 
// Tarkistaa onko käyttäjä sisäänkirjautunut. Jos ei ohjaa kirjautumaan.
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
$loggedUserID = $_SESSION['id'];

require "config.php";
 
$new_password = $confirm_password = $current_password = "";
$new_password_err = $confirm_password_err = $current_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check current password
    if(empty(trim($_POST["current_password"]))){
        $current_password_err = "Please enter the new password.";     
    } else{
        $current_password = trim($_POST["current_password"]);
    }

    // Check new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } else{
        $new_password = trim($_POST["new_password"]);
    }
        
    // Check confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if($new_password != $confirm_password){
            $confirm_password_err = "Password did not match.";
        }
    }

    // checking current password
    $sql = "SELECT haltijaSalasana FROM Tilinhaltija WHERE haltijaID = '$loggedUserID'";
    $resultset = mysqli_query($link, $sql);
    $record = mysqli_fetch_assoc($resultset);
    $password_hash = $record['haltijaSalasana'];
    if (password_verify($current_password, $password_hash)) {
        echo json_encode("toimii");
    }

    if($new_password != $current_password) {

  
    //     // Check input errors before updating the database
    //     if(empty($new_password_err) && empty($confirm_password_err) && empty($current_password_err)){
            // Prepare an update statement
            $sql = "UPDATE Tilinhaltija SET haltijaSalasana = ? WHERE haltijaID = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_userid);
                
                // Set parameters
                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_userid = $loggedUserID; 
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Password updated successfully. Destroy the session, and redirect to login page
                    session_destroy();
                    header("location: login.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
    //     }
    }
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Template for the new android layout">
      <meta name="author" content="Andrew Henry">
      <link rel="icon" href="image/comabanklogo.png">
      <title>ComaBank</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <link rel="stylesheet" href="css/main.css">
      <!-- Google Icons -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
	  <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	  <meta name="mobile-web-app-capable" content="yes">
	  <link rel="manifest" href="/manifest.webmanifest">
   </head>
   <body>
   <center>
              <h4 class="mx-auto" style="color: gray">Salasanan vaihto:</h4>
			<div class="card mt-3 mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);">
			<div class="card-body mx-auto">
			<img class="mb-4" style="border-radius: 50%; border: 1px solid #ddd;margin-left: auto;margin-right: auto;display: block;" src="image/person.png" width="150" height="150">
			<h6 class="d-flex justify-content-center" style="color: gray">Nykyinen salasana:</h6><input class="form-control d-flex justify-content-center mb-3" type="password" id="current-password" style="color: gray"></input>
			<h6 class="d-flex justify-content-center" style="color: gray">Uusi salasana:</h6><input class="form-control d-flex justify-content-center mb-3" type="password" id="new-password" style="color: gray"></input>
			<h6 class="d-flex justify-content-center" style="color: gray">Uusi salasana uudelleen:</h6><input class="form-control d-flex justify-content-center mb-3" type="password" id="new-password-again" style="color: gray"></input>
		</div>
		</div>
		<a class="mx-auto" text="white"><button type="button" id="btn-change-password" data-target="#status-modal" data-toggle="modal"  class="btn btn-info mx-auto mt-3" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 175px">Vaihda salasana</button>
		<a class="mx-auto" href="index.php" text="white"><button type="button" class="btn btn-info mx-auto mt-3" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 175px">Peruuta</button>
   
         <!-- REGISTER MODAL --->
        <div class="modal" tabindex="-1" role="dialog" id="status-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black">Tila</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="color:black" id="modal-text"></p>
            </div>
            <div class="modal-footer">
                <button id="btn-modal" type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
            </div>
        </div>
        </div>
   
         <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <!-- JS needed for this page -->
      <script src="js/change-password.js"></script>
   </body>
</html>