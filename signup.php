<?php
session_start();
require "config.php";
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
         
		  	<div class="card mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); border-radius: 20px;">
			<div class="card-body">
			<h4 class="d-flex justify-content-center mt-3 mb-5" style="color: gray">Rekisteröityminen</h4>
			<form>
			<input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="text" id="register-firstname" placeholder="Etunimi"></input>
			<input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="text" id="register-lastname" placeholder="Sukunimi"></input>
			<input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="text" id="register-address" placeholder="Osoite"></input>
			<input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="text" id="register-postalcode" placeholder="Postinumero"></input>
			<input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="text" id="register-postarea" placeholder="Postitoimipaikka"></input>
			<input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="email" id="register-email" placeholder="Sähköposti"></input>
         <input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="text" id="register-phonenumber" placeholder="Puhelinnumero"></input>
			<input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="password" id="register-password" placeholder="Salasana"></input>
         <input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" type="password" id="register-confirm_password" placeholder="Salasana uudestaan"></input>
			
			</form>
			<button id="btn-signup" class="btn btn-info mx-auto mt-5 d-flex justify-content-center" data-target="#status-modal" data-toggle="modal" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">Rekisteröidy</button>
			<a href="start.php"  class="btn btn-info mx-auto mt-3 mb-5 d-flex justify-content-center" value="Takaisin" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">Takaisin</a>
		</div>
		</div>

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
      <script src="js/signup.js"></script>
   </body>
</html>


<?php

// Signup process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Defining empty variables
$email = $firstname = $lastname = $phonenumber = $postalcode = $postarea = $address = $password = $confirm_password = "";
$email_err = $firstname_err = $lastname_err = $phonenumber_err = $postalcode_err =  $postarea_err = $address_err = $password_err = $confirm_password_err = "";

// Main process starts here
    
    if (isset($_POST['firstname'])) {
        $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['lastname'])) {
        $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['email'])) {
        $email = filter_var($email, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['phonenumber'])) {
        $phonenumber = filter_var($phonenumber, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['postalcode'])) {
        $postalcode = filter_var($postalcode, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['postarea'])) {
      $postarea = filter_var($postarea, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['address'])) {
        $address = filter_var($address, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['password'])) {
        $password = filter_var($password, FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['confirm_password'])) {
        $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);
    }

    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } elseif(strlen(trim($_POST["email"])) < 6){
        $email_err = "Email must have atleast 6 characters.";
    } else{
        // Prepare a select statement
        $sql = "SELECT haltijaID FROM Tilinhaltija WHERE haltijaSposti = ?";
        $email_err = "";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
      
    }

    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter a firstname.";     
    } elseif(strlen(trim($_POST["firstname"])) < 2){
        $firstname_err = "Firstname must have atleast 2 characters.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }
    
    // Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter a lastname.";     
    } else{
        $lastname = trim($_POST["lastname"]);
    }
    $lastname = trim($_POST["lastname"]);
    // Validate postalcode
    if(empty(trim($_POST["postalcode"]))){
        $postalcode_err = "Please enter a postalcode.";     
    } elseif(strlen(trim($_POST["postalcode"])) != 5){
        $postalcode_err = "Postalcode must have 5 characters.";
    } else{
        $postalcode = trim($_POST["postalcode"]);
    }      

        // Validate postarea
        if(empty(trim($_POST["postarea"]))){
          $postarea_err = "Please enter a postarea.";     
      } elseif(strlen(trim($_POST["postarea"])) != 5){
          $postarea_err = "Postarea must have 2 characters.";
      } else{
          $postarea = trim($_POST["postarea"]);
      }    
    
    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter a address.";     
    } elseif(strlen(trim($_POST["address"])) < 4){
        $address_err = "Address must have atleast 4 characters.";
    } else{
        $address = trim($_POST["address"]);
    }     

    // Validate phonenumber
    if(empty(trim($_POST["phonenumber"]))){
        $phonenumber_err = "Please enter a phonenumber.";     
    } elseif(strlen(trim($_POST["phonenumber"])) != 10){
        $phonenumber_err = "phonenumber must have 10 numbers.";
    } else{
        // Prepare a select statement
        $sql = "SELECT haltijaID FROM Tilinhaltija WHERE haltijaPuhnro = ?";
        $phonenumber_err = "";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phonenumber);
            
            // Set parameters
            $param_phonenumber = trim($_POST["phonenumber"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $phonenumber_err = "This phonenumber is already in use.";
                } else{
                    $phonenumber = trim($_POST["phonenumber"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    $randomInt = rand(11111111, 99999999);
    $loop = TRUE;
    while($loop == TRUE) {

      //generate new login ID
      $randomInt = rand(11111111, 99999999);

        // Check if loginID is already taken
            // Prepare a select statement
            $sql = "SELECT haltijaLoginID FROM Tilinhaltija WHERE haltijaLoginID = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_randomInt);
                
                // Set parameters
                $param_randomInt = $randomInt;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // store result
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 0){
                        $loop = FALSE;
                        break;
                    }
                } else{

                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
    }
    
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err)  && empty($confirm_password_err) && empty($postarea_err) &&  empty($address_err) && empty($postalcode_err) && empty($phonenumber_err) && empty($firstname_err) && empty($lastname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Tilinhaltija (haltijaEtunimi, haltijaSukunimi, haltijaOsoite, haltijaPostinumero, haltijaPostipaikka, haltijaPuhnro, haltijaLoginID, haltijaSposti, haltijaSalasana) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssiss", $param_firstname, $param_lastname, $param_address, $param_postalcode, $param_postarea, $param_phonenumber, $param_loginID, $param_email, $param_password);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_address = $address;
            $param_postalcode = $postalcode;
            $param_phonenumber = $phonenumber;
            $param_postarea = $postarea;
            $param_loginID = $randomInt;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "OK";
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>