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
      <!-- Begin page content -->

         <!-- Home page -->
         <div id="page-home" class="active">
	<nav class="fixed-top">
	  <center>
         <h2 class="mx-auto mt-2 navbar-brand mb-0" style="color: gray">ComaBank</h2>
		 			<div class="card mt-3" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); border-radius: 20px;">

         <?php 
            
            
            $sql = "SELECT tiliRahatilanne, tiliNimi, tiliNumero, tiliID FROM Tili WHERE haltijaID = '$loggedUserID' ORDER BY tiliID";
            $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
            $record = mysqli_fetch_assoc($resultset)
            
         ?>
  <div class="card-body">
  <div class="float-left ml-4"> 
    <img style="border-radius: 50%; border: 1px solid #ddd;margin-left: auto;margin-right: auto;display: block;" src="image/person.png" width="45" height="45">
    <h6 class="card-subtitle mb-1 text-muted mt-1"><?php echo utf8_encode($record['tiliNimi']);?></h6>
    <h6 class="card-subtitle mb-1 text-muted mt-1" style="font-size: 12px;"><?php echo $record['tiliNumero'];?></h6>
	</div>  
  <div class="float-right mt-3 mr-4">
    <h5 class="card-title" style="text-decoration: underline; color: gray">Saldo</h5>
    <h6 class="card-subtitle mb-1 text-muted mt-3"><?php echo $record['tiliRahatilanne']; ?> €</h6>
	</div>
  </div>
</div>
		</center>
      </nav>
			<center>
<div>
<h2 id="payment-status" style="border: 0; font-size: 19px; background-color: #f4f4f2; color: red; left: 50%; transform: translate(-50%); width: auto; position: absolute; top: 200px;"></h2>
</div>
    <div class="mr-5 mb-5 mx-auto input-group" style="width: 350px; padding-top: 185px">
        <input class="text-right mb-3" style="border: 0; font-size: 75px; background-color: #f4f4f2; color: gray; width: 200px;" id="code" placeholder="0" readonly>
		<input class="text-center mb-3" style="border: 0; font-size: 75px; background-color: #f4f4f2; color: gray; width: 50px;" value="€" readonly></input>
		<button class="material-icons ml-5 btn button-inactive" style="background-color: #f4f4f2; margin-top: 35px; color: gray; height: 47px" onclick="document.getElementById('code').value=document.getElementById('code').value.slice(0, -1);">backspace</button>
    </div>
	<button id="create" type="button" class="btn button-inactive font-weight-bold" style="background-color: #f4f4f2; font-size: 23px">Vastaanottaja</button></a>
   <p id="target-phone" class="font-weight-bold" style="color: gray; background-color: #f4f4f2; font-size: 15px"></p>
	</center>
	<div class="btn-group-vertical mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: white; border-radius: 5px;" role="group" aria-label="Basic example">
	<div class="btn-group">
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '1';">1</button>
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '2';">2</button>
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '3';">3</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '4';">4</button>
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '5';">5</button>
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '6';">6</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '7';">7</button>
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '8';">8</button>
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '9';">9</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '.';">,</button>
        <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '0';">0</button>
        <a  text="white"><button type="button" id="btn-send-payment" class="btn btn-info py-3" style="background-color: #4cbbc8; width: 117px" >Ok</button></a>
    </div>
</div>
         </div>

         <!-- Feed page -->
         <div id="page-feed" class="inactive">
            <h4 class="mx-auto" style="color: gray">Vastaanotetut:</h4>
            <div class="card mt-3 mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); border-radius: 20px;">

                  <?php

                        $sql = "SELECT haltijaEtunimi, haltijaSukunimi, maksuSumma, maksuAika, maksuID, vastaanottajaNimi FROM Tapahtuma
                        INNER JOIN Tilinhaltija ON
                        Tilinhaltija.haltijaID = Tapahtuma.maksajaID
                        WHERE haltijaID != '$loggedUserID'
                        ORDER BY maksuAika DESC";
                           $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
                           
                        while($record = mysqli_fetch_assoc($resultset)) {
                              
                        ?>

                  <div class="card-body d-flex justify-content-between">
                     <a style="color: gray"><?php echo utf8_encode($record['haltijaEtunimi']), " ", utf8_encode($record['haltijaSukunimi']); ?></a>
                     <a style="color: gray; font-size: 12px; margin-top: 5px;"><?php echo $record['maksuAika'];?></a>
                     <a style="color: green">+<?php echo $record['maksuSumma']; ?> €</a>
                  </div>
               <?php } ?>
            </div>
            <h4 class="mx-auto mt-4" style="color: gray">Maksetut:</h4>
            <div class="card mt-3 mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); border-radius: 20px;">

                  <?php

                        $sql = "SELECT haltijaEtunimi, haltijaSukunimi, maksuSumma, maksuAika, maksuID, vastaanottajaPuhnro, vastaanottajaNimi, maksuKommentti FROM Tapahtuma
                        INNER JOIN Tilinhaltija ON
                        Tilinhaltija.haltijaID = Tapahtuma.maksajaID
                        WHERE MaksajaID = '$loggedUserID'
                        ORDER BY maksuAika DESC";
                           $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
                           
                        while($record = mysqli_fetch_assoc($resultset)) {

                        ?>

                  <div class="card-body d-flex justify-content-between">
                     <a style="color: gray"><?php echo utf8_encode($record['vastaanottajaNimi']); ?></a>
                     <a style="color: gray; font-size: 12px; margin-top: 5px;"><?php echo $record['maksuAika'];?></a>
                     <a style="color: red">-<?php echo $record['maksuSumma']; ?>€</a>
                  </div>
               <?php } ?>
            </div>
         </div>

         <!-- Create page -->
         <div id="page-create" class="inactive">
          <div class="input-group mb-4 mx-auto" style="width: 350px">
            <div class="input-group-prepend">
              <button  class="btn btn-info" style="background-color: #4cbbc8"><span class="material-icons mt-1">arrow_back</span></button>
            </div>
            <input type="search" placeholder="Hae vastaanottaja" aria-describedby="button-addon7" class="form-control">
          </div>
          

               <?php


                  $sql = "SELECT haltijaID, haltijaEtunimi, haltijaSukunimi, haltijaPuhnro  FROM Tilinhaltija WHERE haltijaID != '$loggedUserID' ORDER BY haltijaSukunimi";
                  $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link));
                  
                  $i = 0;
                  
                  while($record = $resultset-> fetch_row()) {

                        if($i % 1 == 0 || $i % 4 == 0) {
                           $print_id = $record[0];
                        }
                        if($i % 1 == 1) {
                           $print_firstname = $record[$i];
                        }
                        else {
                           $print_firstname = $record[1];
                        }
                        if($i % 1 == 2) {
                           $print_lastname = $record[$i];
                        }
                        else{
                           $print_lastname = $record[2];
                        }
                        if($i % 1 == 3) {
                           $print_phone = $record[$i];
                        }
                        else{
                           $print_phone = $record[3];
                        }
                     
               ?>
               <div class="card mx-auto mb-2" style="overflow: hidden; background: #FFFFFF; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);" >
                  <button class="btn btn-secondary card-block stretched-link button-inactive contact-card" style="background: #FFFFFF;" onclick="test()">
                     <div class="card-body d-flex justify-content-between" style="background: #FFFFFF; width: 350px; height: 60px">
                           <img src="image/person.png" alt="person img" style="width: 25px; height: 25px;">
                           <a class="card-contact-id" style="color: gray" id="<?php $print_id ?>" value="<?php $print_id ?>"></a>
                           <a class="card-contact-name" style="color: gray" value="<?php $print_firstname . " " . $print_lastname ?>" style="color: black;"><?php echo $print_firstname, " ", $print_lastname; ?></a>
                           <a class="card-contact-phone" style="color: gray"  value="<?php  $print_phone; ?>" style="color: black;"><?php echo $print_phone; ?></a>
                     </div>
                     </button>
               </div>
               <?php 
                  $i++;
                  }
                  ?>
            </div>
		
		</div>
         </div>

         <!-- Account page -->
         <div id="page-account" class="inactive">
           <h4 class="mx-auto" style="color: gray">Käyttäjä:</h4>
			<div class="card mt-3 mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); border-radius: 20px;">
			<div class="card-body">
         
         <?php $sql = "SELECT haltijaEtunimi, haltijaSukunimi, haltijaPuhnro, haltijaOsoite, haltijaPostipaikka, haltijaPostinumero, haltijaSposti FROM Tilinhaltija WHERE haltijaID = '$loggedUserID'";
                  $resultset = mysqli_query($link, $sql) or die("database error:". mysqli_error($link)); 
                  $record = mysqli_fetch_assoc($resultset)
         ?>

			<img class="mb-4" style="border-radius: 50%; border: 1px solid #ddd;margin-left: auto;margin-right: auto;display: block;" src="image/person.png" width="150" height="150">
			<h6 class="d-flex justify-content-center mb-3" style="color: gray"><?php echo utf8_encode($record['haltijaEtunimi']), " ",utf8_encode($record['haltijaSukunimi']) ?></h6>
			<h6 class="d-flex justify-content-center mb-3" style="color: gray"><?php echo utf8_encode($record['haltijaOsoite']); ?></h6>
			<h6 class="d-flex justify-content-center mb-3" style="color: gray"><?php echo $record['haltijaPostinumero'], " ", utf8_encode($record['haltijaPostipaikka']) ?></h6>
			<h6 class="d-flex justify-content-center mb-3" style="color: gray"><?php echo $record['haltijaSposti']; ?></h6>
			<h6 class="d-flex justify-content-center mb-3" style="color: gray"><?php echo $record['haltijaPuhnro']; ?></h6>
		</div>
		</div>
         <a class="mx-auto" href="update-information.php" text="white"><button type="button" class="btn btn-info mx-auto mt-3" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">Muuta tietoja</button></a>
         <a class="mx-auto" href="change-password.php" text="white"><button type="button" class="btn btn-info mx-auto mt-3" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">Vaihda salasana</button></a>
         <a class="mx-auto" href="logout.php" text="white"><button type="button" class="btn btn-danger mx-auto mt-3" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); width: 200px">Kirjaudu ulos</button></a>
               

   </div>


      <!-- Bottom Nav Bar -->
      <footer class="footer">
         <div id="buttonGroup" class="btn-group selectors" role="group" aria-label="Basic example">
            <button id="home" type="button" class="btn btn-secondary button-active">
               <div class="selector-holder">
                  <i class="material-icons">home</i>
                  <span>Koti</span>
               </div>
            </button>
            <button id="feed" type="button" class="btn btn-secondary button-inactive">
               <div class="selector-holder">
                  <i class="material-icons">view_list</i>
                  <span>Tapahtumat</span>
               </div>
            </button>
            <button id="account" type="button" class="btn btn-secondary button-inactive">
               <div class="selector-holder">
                  <i class="material-icons">account_circle</i>
                  <span>Käyttäjä</span>
               </div>
            </button>
         </div>
         <button id="3" onClick="reply_click(this.id)">B3</button>
    
<script type="text/javascript">
  function reply_click(clicked_id)
  {
      alert(clicked_id);
  }
</script>
      </footer>
	  
      <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <!-- JS needed for this page -->
      <script src="js/main.js"></script>
      <script>

      
   function myFunction() {
      var input, filter, cards, cardContainer, h5, title, i;
      input = document.getElementById("myFilter");
      filter = input.value.toUpperCase();
      cardContainer = document.getElementById("myItems");
      cards = cardContainer.getElementsByClassName("card");
      for (i = 0; i < cards.length; i++) {
         title = cards[i].querySelector(".card-body h5.card-title");
         if (title.innerText.toUpperCase().indexOf(filter) > -1) {
               cards[i].style.display = "";
         } else {
               cards[i].style.display = "none";
         }
      }
   }
      </script>
   </body>
</html>



<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Defining empty variables
   $paymentAmount = $_SESSION['paymentAmount']; 
   $paymentTarget = $_SESSION['paymentTarget']; 
   $paymentAmount_err = $paymentTarget_err = "";
   
   
   // Main process starts here
       
      if (isset($_POST['paymentAmount'])) {
         $paymentAmount = filter_var($paymentAmount, FILTER_SANITIZE_STRING);
      }
      if (isset($_POST['paymentTarget'])) {
         $paymentTarget = filter_var($paymentTarget, FILTER_SANITIZE_STRING);
      }
      if (isset($_POST['paymentTargetPhone'])) {
         $paymentTarget = filter_var($paymentTarget, FILTER_SANITIZE_STRING);
      }
   
         if(empty(trim($_POST["paymentTarget"]))){
            $paymentTarget_err = "Please enter a recipient for the payment.";     
        } else{
            $paymentTarget = trim($_POST["paymentTarget"]);
            $paymentTargetPhone = trim($_POST["paymentTargetPhone"]);
        }      
    
         if(empty(trim($_POST["paymentAmount"]))){
              $paymentAmount_err = "Please enter an amount to transfer.";     
          } else{
              $paymentAmount = trim($_POST["paymentAmount"]);
          }   

            
       
       // Check input errors before inserting in database
       if(empty($paymentAmount_err) && empty($paymentAmount_err)){
           
               // Prepare an insert statement
               session_start();
                                    
               // Store data in session variables
               $_SESSION["paymentTarget"] = $paymentTarget;
               $_SESSION["paymentAmount"] = $paymentAmount;
               $_SESSION["paymentTargetPhone"] = $paymentTargetPhone;                            
               
               // Redirect user to payment page
               header("location: confirm-payment.php");
               
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
       
       // Close connection
       mysqli_close($link);
   }

?>