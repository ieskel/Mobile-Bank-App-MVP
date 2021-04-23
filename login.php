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

require "config.php";
 
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    

    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT haltijaID, haltijaSposti, haltijaSalasana FROM Tilinhaltija WHERE haltijaSposti = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $email_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
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
         
		  	<div class="card mx-auto" style="width: 350px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); border-radius: 20px; margin-top: 150px">
			<div class="card-body">
			<h4 class="d-flex justify-content-center mt-5 mb-5" style="color: gray">Kirjautuminen</h4>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input class="form-control mx-auto d-flex justify-content-center mb-3" style="color: gray;" name="email" id="email" placeholder="Sähköposti" required></input>
                <input class="form-control mx-auto d-flex justify-content-center mb-5" style="color: gray;" name="password" id="password" type="password" placeholder="Salasana" required></input>
                <input type="submit" class="btn btn-info mx-auto d-flex justify-content-center" value="Kirjaudu" style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">
            </form>
			<a href="start.php" class="btn btn-info mx-auto mt-3 mb-5 d-flex justify-content-center"  style="border-radius: 15px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); background-color: #4cbbc8; width: 200px">Takaisin</a>
		</div>
		</div>
   
         <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   </body>
</html>