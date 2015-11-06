<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WSPABL: Contact</title>

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
    <?php
include 'header.php';
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            
                <!--<?php
include 'nav.php';
?>-->
            

            <div class="col-md-9">
                <div class="thumbnail">
                    <img class="img-responsive" src="images/bballs.jpg" alt="Bowling Balls">
                </div>

                <div class="well">
                    <div class="row">
                        <div class="col-md-12">
                        	<h1>Contact Us!</h1>
							<form action="contact.php" method="post">
							 Have any questions or comments for the league? Feel free to share them here, along with your e-mail address, and we'll get in touch with you soon!<br>
							 <textarea name="message" rows="10" cols="25"></textarea><br><br>
							 Your e-mail address: (optional)<br>
							 <input type="text" name="email"><br>
							<input type="submit">
							<input type="hidden" name="formSubmitted" value="true"></form>
							
			<?php
if (isset($_POST["formSubmitted"])) {
    if (empty($_POST["message"])) {
        echo "<br><b>Please enter a message first!</b>";
    } else {
        mail("skracing@gmail.com", "New feedback!", ($_POST["message"]));
        if (filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            mail(($_POST["email"]), "Confirmation of Feedback", "Thank you very much for your feedback! We appreciate your
								support of the WSPABL.");
        }
        echo "<br><b>Message sent! Thank you for your feedback!</b>";
    }
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
            <?php
include 'footer.php';
?>

    <!-- /.container -->

</body>

</html>
Option 2: Or type in the URL to your HTML file

http://www.example.com/myfile.html
Indentation level:

Force output to new window:

FORMAT HTML
Formatted HTML:
<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>WSPABL: Contact</title>
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
      <?php
         include 'header.php';
         ?>
      <!-- Page Content -->
      <div class="container">
         <div class="row">
            <!--<?php
               include 'nav.php';
               ?>-->
            <div class="col-md-9">
               <div class="thumbnail">
                  <img class="img-responsive" src="images/bballs.jpg" alt="Bowling Balls">
               </div>
               <div class="well">
                  <div class="row">
                     <div class="col-md-12">
                        <h1>Contact Us!</h1>
                        <form action="contact.php" method="post">
                           Have any questions or comments for the league? Feel free to share them here, along with your e-mail address, and we'll get in touch with you soon!<br>
                           <textarea name="message" rows="10" cols="25"></textarea><br><br>
                           Your e-mail address: (optional)<br>
                           <input type="text" name="email"><br>
                           <input type="submit">
                           <input type="hidden" name="formSubmitted" value="true">
                        </form>
                        <?php
                           if (isset($_POST["formSubmitted"])) {
                               if (empty($_POST["message"])) {
                                   echo "<br><b>Please enter a message first!</b>";
                               } else {
                                   mail("skracing@gmail.com", "New feedback!", ($_POST["message"]));
                                   if (filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
                                       mail(($_POST["email"]), "Confirmation of Feedback", "Thank you very much for your feedback! We appreciate your
                           								support of the WSPABL.");
                                   }
                                   echo "<br><b>Message sent! Thank you for your feedback!</b>";
                               }
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
      <?php
         include 'footer.php';
         ?>
      <!-- /.container -->
   </body>
</html>
COPY TO CLIPBOARD	 SELECT ALL 
© FreeFormatter.com - Brought to you by MrForms. NEQ: 2269075125

