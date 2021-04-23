<?php
session_start();
  
$loggedUserID = $_SESSION['id'];
  
require "config.php";


  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
      // Main process starts here
          if (isset($_POST['paymentAmount'])) {
              $paymentAmount = filter_var($paymentAmount, FILTER_SANITIZE_STRING);
              $paymentAmount = trim($_POST['paymentAmount']);
          }
          if (isset($_POST['paymentComment'])) {
            $paymentComment = filter_var($paymentComment, FILTER_SANITIZE_STRING);
            $paymentComment = trim($_POST['paymentComment']);            
          }
          if (isset($_POST['paymentTarget'])) {
            $paymentTarget = filter_var($paymentTarget, FILTER_SANITIZE_STRING);
            $paymentTarget = trim($_POST['paymentTarget']); 
          }
          if (isset($_POST['paymentTargetPhone'])) {
            $paymentTargetPhone = filter_var($paymentTargetPhone, FILTER_SANITIZE_STRING);
            $paymentTargetPhone = trim($_POST['paymentTargetPhone']); 
          }
          
          // removing empty space and € sign from the end of the string
          $paymentAmount = substr($paymentAmount, 0, -4);

          // finding sender's account balance
          $sql3 = "SELECT tiliRahatilanne FROM Tili WHERE haltijaID = '$loggedUserID'";
          $resultset2 = mysqli_query($link, $sql3) or die("database error:". mysqli_error($link));
          $record2 = mysqli_fetch_assoc($resultset2);
          
          if($record2['tiliRahatilanne'] >= $paymentAmount) {
            //finding latest block
            $sql2 = "SELECT blockHash FROM Tapahtuma ORDER BY maksuID DESC LIMIT 1";
            $resultset = mysqli_query($link, $sql2) or die("database error:". mysqli_error($link));
            $record = mysqli_fetch_assoc($resultset);
            $previousHash = $record['blockHash'];
            
            //preparing the hash
            $concat = $paymentTarget.$paymentTargetPhone.$paymentComment.$paymentAmount.$loggedUserID.$previousHash;
            
            $algos = hash_algos();
            
            // algos[9] is SHA512
            $hash = hash($algos[9] ,$concat, false);          
            
                // inserting everything into DB
                $sql = "INSERT INTO `Tapahtuma`(maksuKommentti, maksuSumma, vastaanottajaPuhnro, vastaanottajaNimi, maksajaID, blockHash, previousHash)
                        VALUES ('$paymentComment', '$paymentAmount', '$paymentTargetPhone', '$paymentTarget','$loggedUserID', '$hash', '$previousHash')";
            
                if ($link->query($sql) === TRUE) {
                  $response = "Maksu suoritettu. Summa: `$paymentAmount`";

                    // updating account balance
                    $newBalance = $record2['tiliRahatilanne'] - $paymentAmount;
                    $sqlBalance = "UPDATE `Tili` SET `tiliRahatilanne` = '$newBalance' WHERE haltijaID = '$loggedUserID'";
                    mysqli_query($link, $sqlBalance) or die("database error:". mysqli_error($link));
                  
                } else {
                  $response = "Ongelma: " . $link->error;
                }
              
          }
          else {
            $response = "Tilillä ei ole tarpeeksi varoja.";
          }

          echo json_encode($response);
  
          // Close connection
          mysqli_close($link);
          
}
?>