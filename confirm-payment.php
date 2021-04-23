<?php
session_start();
require "config.php";

// Check if user is logged in; if not, redirect to login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   header("location: login.php");
   exit;
}

$loggedUserID = $_SESSION['id'];
$paymentAmount = $_SESSION['paymentAmount'];
$paymentTarget = $_SESSION['paymentTarget'];
$paymentTargetPhone = $_SESSION['paymentTargetPhone'];


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
         
          <div class="input-group mb-4 mx-auto" style="width: 350px">
            <div class="input-group-prepend">
              <a href="index.php" id="btn-back" class="btn btn-info" style="background-color: #4cbbc8; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2)"><span class="material-icons mt-1">arrow_back</span></a>
            </div>
			<div class="card mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);">
            <h4 class="ml-3" style="color: gray; margin-top: 11px">Lähetä rahaa</h4>
			</div>
          </div>
          
         <?php 
            
            
            $sql = "SELECT tiliRahatilanne, tiliNimi, tiliNumero, tiliID FROM Tili WHERE haltijaID = '$loggedUserID' ORDER BY tiliID";
            $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
            $record = mysqli_fetch_assoc($resultset)
            
         ?>

		  	<div class="card mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);">
			<div class="card-body">
			<img class="mb-4" style="border-radius: 50%; border: 1px solid #ddd;margin-left: auto;margin-right: auto;display: block;" src="image/person.png" width="100" height="100">
			<h6 class="d-flex justify-content-center" style="color: gray" id="payment-target"><?php echo $paymentTarget ?></h6>
			<h6 class="d-flex justify-content-center" style="color: gray" id="payment-target-phone"><?php echo $paymentTargetPhone ?></h6>
			<h2 class="d-flex justify-content-center mt-4" style="color: gray" id="payment-amount"><?php echo $paymentAmount ?> €</h2>
         <input placeholder="Viesti" class="form-control mx-auto mt-4" style="color: gray" id="payment-comment"></input>
		</div>
		</div>
		<center>
		<a class="mx-auto" text="white"><button type="button" id="btn-accept-payment" class="btn btn-info mx-auto mt-3" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">Hyväksy</button>
      <h2 class="d-flex justify-content-center mt-4" style="color: gray" id="payment-status"></h2>
   
         <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <!-- JS needed for this page -->
      <script src="js/payment.js"></script>
   </body>
</html>


