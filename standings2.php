<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>WSPABL: Games by Date</title>
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
    
    echo "<TABLE id=\"standings\" BORDER=\"5\" WIDTH=\"50%\" CELLPADDING=\"4\" CELLSPACING=\"3\">
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
    echo "</table><br>";
    
    echo "<h3><a href=\"standings.php\">Team-by-team</a> | <b>Games by Date</b> | <a href=\"standings3.php\">Leaderboards</a></h3>";
    
    $getDates   = "SELECT DISTINCT gameDate
                           FROM Game";
    $dateResult = mysql_query($getDates);
    while ($dRow = mysql_fetch_array($dateResult)) {
        $usaDate = strtotime($dRow[0]);
        $usaDate = date("F j, Y", $usaDate);
        echo "<br><br><h3>" . $usaDate . "</h3><br>";
        
        $getScores   = "SELECT Game.gameKey, TeamGame.teamKey, TeamGame.p1score, TeamGame.p2score, TeamGame.p3score
                           FROM TeamGame
                           INNER JOIN Game ON TeamGame.gameKey = Game.gameKey
                           WHERE Game.gameDate LIKE \"" . $dRow[0] . "\"";
        $scoreResult = mysql_query($getScores);
        
        $teamCounter = 1;
        
        
        while ($sRow = mysql_fetch_array($scoreResult)) {
            if ($teamCounter == 1) {
                $teamOne     = array();
                $teamTwo     = array();
                $teamOneInfo = array();
                $teamTwoInfo = array();
                
                array_push($teamOne, $sRow[1], $sRow[2], $sRow[3], $sRow[4]);
                $teamCounter++;
            } else {
                array_push($teamTwo, $sRow[1], $sRow[2], $sRow[3], $sRow[4]);
                
                $getTeamOneInfo = "SELECT teamName, player1, player2, player3 FROM Team WHERE teamKey LIKE \"" . $teamOne[0] . "\"";
                $teamOneResult  = mysql_query($getTeamOneInfo);
                while ($tRow = mysql_fetch_array($teamOneResult)) {
                    array_push($teamOneInfo, $tRow[0], $tRow[1], $tRow[2], $tRow[3]);
                }
                
                $getTeamTwoInfo = "SELECT teamName, player1, player2, player3 FROM Team WHERE teamKey LIKE \"" . $teamTwo[0] . "\"";
                $teamTwoResult  = mysql_query($getTeamTwoInfo);
                while ($tRow = mysql_fetch_array($teamTwoResult)) {
                    array_push($teamTwoInfo, $tRow[0], $tRow[1], $tRow[2], $tRow[3]);
                }
                
                
                echo "<br><br><TABLE id=\"standings\" BORDER=\"5\" WIDTH=\"50%\" CELLPADDING=\"4\"
                           CELLSPACING=\"3\">
                           <tr align=\"center\">
                           		<td COLSPAN=\"2\"><H4>" . $teamOneInfo[0] . "</H4>
                           	 </td>
                           <td COLSPAN=\"2\"><H4>" . $teamTwoInfo[0] . "</H4>
                           </tr>
                           <tr align=\"center\">
                             <Td>Player</Td>
                             <Td>Score</Td>
                             <Td>Player</Td>
                             <Td>Score</Td>
                           </tr>";
                
                $teamOneScore = 0;
                $teamTwoScore = 0;
                
                for ($i = 1; $i <= 3; $i++) {
                    echo "<tr align=\"center\">";
                    echo "<td>" . $teamOneInfo[$i] . "</td>";
                    echo "<td>" . $teamOne[$i] . "</td>";
                    echo "<td>" . $teamTwoInfo[$i] . "</td>";
                    echo "<td>" . $teamTwo[$i] . "</td></tr>";
                    
                    $teamOneScore = $teamOneScore + $teamOne[$i];
                    $teamTwoScore = $teamTwoScore + $teamTwo[$i];
                }
                
                
                
                echo "<tr align=\"center\">";
                echo "<td><b>Total:</b></td>";
                if ($teamOneScore == $teamTwoScore) {
                    echo "<td><font color=blue><b>" . $teamOneScore . "</b></font></td>";
                    echo "<td><b>Total:</b></td>";
                    echo "<td><font color=blue><b>" . $teamTwoScore . "</b></font></td></tr>";
                } else if ($teamOneScore > $teamTwoScore) {
                    echo "<td><font color=red><b>" . $teamOneScore . "</b></font></td>";
                    echo "<td><b>Total:</b></td>";
                    echo "<td>" . $teamTwoScore . "</td></tr>";
                } else {
                    echo "<td>" . $teamOneScore . "</td>";
                    echo "<td><b>Total:</b></td>";
                    echo "<td><font color=red><b>" . $teamTwoScore . "</b></font></td></tr>";
                }
                ;
                echo "</tr>";
                
                echo "<TABLE id=\"standings\" BORDER=\"5\"    WIDTH=\"50%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">";
                
                $teamCounter = 1;
                unset($teamOne);
                unset($teamTwo);
                unset($teamOneInfo);
                unset($teamTwoInfo);
            }
        }
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