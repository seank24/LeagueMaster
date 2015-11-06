<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>The Western Seattle Pro-Am Bowling League</title>
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
                        <h1><?php greetUser() ?></h1>
                        
                        <?php
$myForm = '<form action="index.php" method="post">
                           Username: <input type="text" name="username"><br>
                           Password: <input type="password" name="password"><br>
                           <input type="submit" value="Log In">
                           <input type="hidden" name="formSubmitted" value="true">
                           </form>';


if (isset($_SESSION["username"])) {
    echo "<p>Welcome, " . $_SESSION["username"] . ", to the internet web portal of the fastest-growing bowling league in the Jewel of the Northwest, Seattle, Washington.</p>";
    $logout = '<form action="logout.php" method="post"><input type="submit" value="Log Out"></form>';
    echo $logout;
    echo "<br><p><b>Total Hits: </b>" . getHits() . "</p>";
} else if (isset($_POST["formSubmitted"])) {
    $db = mysql_connect('mysql9.000webhost.com', 'a8602504_bowler', 'bowler1') or die("Unable to connect!");
    mysql_select_db('a8602504_bowl', $db) or die("Unable to select!");
    
    $query1 = "SELECT username, password FROM User WHERE username LIKE '" . $_POST["username"] . "' AND password LIKE '" . $_POST["password"] . "'";
    
    $result = mysql_query($query1);
    
    if (!mysql_fetch_array($result, MYSQL_NUM)) {
        echo "<p>Welcome to the internet web portal of the fastest-growing bowling league in the Jewel of the Northwest, Seattle, Washington. Please log in here to view standings!</p>";
        echo $myForm;
        echo "<h4>Sorry, that was an incorrect username and/or password.</h4>";
    } else {
        $_SESSION["username"] = $_POST["username"];
        header("refresh:2, url=standings.php");
        echo "<h3>Welcome! Redirecting you to the user area...</h3>";
    }
    
    mysql_close($db);
    
} else {
    echo "<p>Welcome to the internet web portal of the fastest-growing bowling league in the Jewel of the Northwest, Seattle, Washington. Please log in here to view standings!</p>";
    echo $myForm;
    
    echo "<br><p><b>Total Hits: </b>" . getHits() . "</p>";
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
<?php
   ?>