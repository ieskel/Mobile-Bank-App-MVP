<?php
session_start();

/*
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/../../config.php'); 
*/


// Check if the user is already logged in, if yes then redirect to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
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
         
		  	<div class="card mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); border-radius: 20px; margin-top: 150px">
			<div class="card-body">
			<img class="mb-5 mt-5" style="margin-left: auto;margin-right: auto;display: block;" src="image/comabanklogo.png" width="75" height="75">
			<a href="signup.php" type="button" class="btn btn-outline-secondary mx-auto mt-5 d-flex justify-content-center" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); width: 200px">Rekisteröidy</a>
			<a href="login.php" type="button" class="btn btn-info mx-auto mt-3 mb-5 d-flex justify-content-center" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">Kirjaudu sisään</a>
		</div>
		</div>
   
         <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <!-- JS needed for this page -->
   </body>
</html>