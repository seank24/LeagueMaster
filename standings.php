<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>WSPABL: Standings</title>
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
                        <h1>Welcome to the Members' Page!</h1>
                        <br>
                        
                        <?php
if (isset($_SESSION["username"])) {
    
    $db = mysql_connect('mysql9.000webhost.com', 'a8602504_bowler', 'bowler1') or die("Unable to connect!");
    mysql_select_db('a8602504_bowl', $db) or die("Unable to select!");
    
    $getStand = "SELECT teamName AS \"Team\", wins AS \"W\", losses AS \"L\", wins / ( wins + losses ) AS \"Pct.\"	FROM Team ORDER BY wins / ( wins + losses ) DESC";
    
    $result = mysql_query($getStand);
    
    echo "<TABLE id=\"standings\" BORDER=\"5\"    WIDTH=\"50%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
                           <tr align=\"center\">
                           <td COLSPAN=\"4\"><H3>CURRENT STANDINGS</h3></td>									
                           </tr><tr align=\"center\">
                           <td><b>Team</b></td>
                           <td><b>Wins</b></td>
                           <td><b>Losses</b></td>
                           <td><b>Win Pct.</b></td>
                           </tr>";
    while ($row = mysql_fetch_array($result)) {
        echo "<tr align=\"center\">";
        echo "<td>" . $row[0] . "</td>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        
        $winPct = number_format($row[3], 3, ".", " ");
        $winPct = ltrim($winPct, "0");
        
        echo "<td>" . $winPct . "</td>";
        echo "</tr>";
    }
    echo "</table><br><br>";
    
    echo "<h3><b>Team-by-team</b> | <a href=\"standings2.php\">Games by Date</a> | <a href=\"standings3.php\">Leaderboards</a></h3><br><br>";
    
    for ($t = 1; $t <= 4; $t++) {
        
        $getTeam = "SELECT teamName, player1, player2, player3
                           FROM Team WHERE Team.teamKey =" . $t . " UNION 
                           SELECT teamGameNum, p1score, p2score, p3score FROM TeamGame
                           WHERE TeamGame.teamKey =" . $t;
        
        $teamResult = mysql_query($getTeam);
        $headerRow  = mysql_fetch_row($teamResult);
        
        echo "<TABLE id=\"standings\" BORDER=\"5\" WIDTH=\"50%\" CELLPADDING=\"4\"
                           CELLSPACING=\"3\">
                           <tr align=\"center\">
                           		<td COLSPAN=\"6\"><H4>" . $headerRow[0] . "</H4>
                           	 </td>
                           </tr>
                           <tr align=\"center\">
                             <Td><b>Player</b></Td>
                             <Td>Game 1</Td>
                             <Td>Game 2</Td>
                             <Td>Game 3</Td>
                             <Td>Game 4</Td>
                             <td><b>Average</b></td>
                           </tr>";
        
        $array1 = array();
        $array2 = array();
        $array3 = array();
        
        while ($row = mysql_fetch_array($teamResult)) {
            $array1[] = $row[1];
            $array2[] = $row[2];
            $array3[] = $row[3];
        }
        
        for ($i = 1; $i <= 3; $i++) {
            $player = ${"array" . $i};
            echo "<tr align=\"center\">";
            echo "<td><b>" . $headerRow[$i] . "</b></td>";
            for ($j = 0; $j < count($player); $j++) {
                echo "<td>" . $player[$j] . "</td>";
            }
            $avg = round(array_sum($player) / count($player));
            echo "<td><b>" . $avg . "</b></td>";
        }
        
        echo "</table><br><br>";
    }
    
} else {
    echo "<h4>You must be logged in to see this content!</h4>";
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