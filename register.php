<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>WSPABL: Register</title>
      <style>
         body {
         padding-top: 70px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
         }
         footer {
         margin: 50px 0;
         }
      </style>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <!-- Custom CSS -->
      <link href="css/styles.css" rel="stylesheet">
   </head>
   <body>
      <!-- Navigation -->
      <?php include 'header.php' ?>
      <!-- Page Content -->
      <div class="container">
         <div class="row">
            <!--<?php include 'nav.php' ?>-->
            <div class="col-md-9">
               <div class="thumbnail">
                  <img class="img-responsive" src="images/bballs.jpg" alt="Bowling Balls">
               </div>
               <div class="well">
                  <div class="row">
                     <div class="col-md-12">
                        <h1>Register an account!</h1>
                        <p>Get started here and sign up for access privileges and all the latest scores on our website about bowling!</p>
                        <br>
                        
                        <?php
$myForm = '<form action="register.php" method="post">
                           	<p><label>Username:</label> <input type="text" name="username"></p>
                           	<p><label>Password:</label> <input type="password" name="password"></p>
                           	<p><label>Repeat Password:</label> <input type="password" name="pvalid"></p>
                           	<p><label>E-mail:</label> <input type="email" name="email"></p>
                           	<p><label>Name:</label> <input type="text" name="yourname"></p>
                           	<p><input type="submit" value="Sign Up!"></p>
                           	<input type="hidden" name="formSubmitted" value="true">
                           	</form>';

if (isset($_POST["formSubmitted"])) {
    if (empty($_POST["username"])) {
        echo $myForm;
        echo "<h4>Pick a username first!</h4>";
    } else if (empty($_POST["password"])) {
        echo $myForm;
        echo "<h4>Enter a password to use!</h4>";
    } else if (($_POST["password"]) != ($_POST["pvalid"])) {
        echo $myForm;
        echo "<h4>Make sure you've typed in the same password both times!</h4>";
    } else if (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        echo $myForm;
        echo "<h4>Please enter a valid e-mail address!</h4>";
    } else {
        $db = mysql_connect('mysql9.000webhost.com', 'a8602504_bowler', 'bowler1') or die("Unable to connect!");
        mysql_select_db('a8602504_bowl', $db) or die("Unable to select!");
        
        $newUser = "INSERT INTO User (username, password, email, name) VALUES ('" . ($_POST["username"]) . "', '" . ($_POST["password"]) . "', '" . ($_POST["email"]) . "', '" . ($_POST["yourname"]) . "')";
        
        mysql_query($newUser);
        
        $_SESSION["username"] = $_POST["username"];
        header("refresh:4, url=standings.php");
        echo "<h3>Thank you for signing up! Sending you to the user area now...</h3>";
    }
} else {
    echo $myForm;
}

?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.container -->
      <!-- Footer -->
      <?php include 'footer.php' ?>
      <!-- /.container -->
   </body>
</html>