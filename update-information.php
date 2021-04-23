<?php
session_start();
require "config.php";

// Check if user is logged in; if not, redirect to login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   header("location: login.php");
   exit;
}

$loggedUserID = $_SESSION['id'];
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

      <?php
         $sql = "SELECT haltijaEtunimi, haltijaSukunimi, haltijaPuhnro, haltijaSposti, haltijaOsoite, haltijaPuhnro, haltijaPostinumero, haltijaPostipaikka  FROM Tilinhaltija WHERE haltijaID = '$loggedUserID'";
         $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
         $record = mysqli_fetch_assoc($resultset);
      ?>

              <h4 class="mx-auto" style="color: gray">Tietojen muutos:</h4>
			<div class="card mt-3 mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);">
			<div class="card-body mx-auto">
			<img class="mb-4" style="border-radius: 50%; border: 1px solid #ddd;margin-left: auto;margin-right: auto;display: block;" src="image/person.png" width="150" height="150">
			<h6 class="d-flex justify-content-center" style="color: gray">Nimi:</h6><input class="d-flex justify-content-center mb-3" style="color: gray" id="firstname" value="<?php echo utf8_encode($record['haltijaEtunimi']);?>" placeholder="<?php echo utf8_encode($record['haltijaEtunimi']);?>"></input>
         <h6 class="d-flex justify-content-center" style="color: gray">Nimi:</h6><input class="d-flex justify-content-center mb-3" style="color: gray" id="lastname" value="<?php echo utf8_encode($record['haltijaSukunimi']);?>" placeholder="<?php echo utf8_encode($record['haltijaSukunimi']);?>"></input>
			<h6 class="d-flex justify-content-center" style="color: gray">Osoite:</h6><input class="d-flex justify-content-center mb-3" style="color: gray" id="address" value="<?php echo utf8_encode($record['haltijaOsoite']); ?>" placeholder="<?php echo utf8_encode($record['haltijaOsoite']) ?>"></input>
			<h6 class="d-flex justify-content-center" style="color: gray">Postinumero:</h6><input class="d-flex justify-content-center mb-3" style="color: gray" id="postalcode" value="<?php echo $record['haltijaPostinumero']; ?>" placeholder="<?php echo $record['haltijaPostinumero']?>"></input>
			<h6 class="d-flex justify-content-center" style="color: gray">Postitoimipaikka:</h6><input class="d-flex justify-content-center mb-3" style="color: gray" id="postarea" value="<?php echo utf8_encode($record['haltijaPostipaikka'])?>" placeholder="<?php echo utf8_encode($record['haltijaPostipaikka'])?>"></input>
			<h6 class="d-flex justify-content-center" style="color: gray">Sähköposti:</h6><input class="d-flex justify-content-center mb-3" style="color: gray" id="email" value="<?php echo $record['haltijaSposti'];?>" placeholder="<?php echo $record['haltijaSposti'];?>"></input>
			<h6 class="d-flex justify-content-center" style="color: gray">Puhelinnumero</h6><input class="d-flex justify-content-center mb-3" style="color: gray" id="phonenumber" value="<?php echo $record['haltijaPuhnro'];?>" placeholder="<?php echo $record['haltijaPuhnro'];?>"></input>
		</div>
		</div>
		<a class="mx-auto" text="white"><button type="button" data-target="#status-modal" data-toggle="modal" id="btn-update-information" class="btn btn-info mx-auto mt-3" style="background-color: #4cbbc8; width: 175px">Muuta tiedot</button></a>
		<a class="mx-auto" href="index.php" text="white"><button type="button" class="btn btn-info mx-auto mt-3" style="background-color: #4cbbc8; width: 175px">Peruuta</button></a>
   
<!-- UPDATE INFORMATION MODAL --->
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
        <button type="button" id="btn-modal" class="btn btn-success" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
   
         <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <!-- JS needed for this page -->
      <script src="js/update-information.js"></script>
   </body>
</html>

<?php

// Signup process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
   
       // Validate username
       if(empty(trim($_POST["email"]))){
           $email_err = "Please enter an email.";
       } elseif(strlen(trim($_POST["email"])) < 6){
           $email_err = "Email must have atleast 6 characters.";
       } else{
           // Prepare a select statement
           $sql = "SELECT haltijaID FROM Tilinhaltija WHERE haltijaSposti = ? AND haltijaID != '$loggedUserID'";
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
       } else {
            $lastname = trim($_POST["lastname"]);
       }
       
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
           $sql = "SELECT haltijaID FROM Tilinhaltija WHERE haltijaPuhnro = ? AND haltijaID != '$loggedUserID'";
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
       
       
       // Check input errors before inserting in database
       if(empty($email_err) && empty($phonenumber_err)  && empty($postarea_err) &&  empty($address_err) && empty($postalcode_err) && empty($firstname_err) && empty($lastname_err)){
           
           // Prepare an insert statement
           $sql = "UPDATE Tilinhaltija SET haltijaEtunimi = '$firstname', haltijaSukunimi = '$lastname', haltijaSposti = '$email', haltijaPostinumero = '$postalcode', haltijaPostipaikka = '$postarea', haltijaOsoite = '$address', haltijaPuhnro = '$phonenumber' WHERE haltijaID = '$loggedUserID'";
           mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
               
           
       }
       
       // Close connection
       mysqli_close($link);
}

?>