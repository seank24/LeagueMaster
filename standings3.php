<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>WSPABL: Leaderboards</title>
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
    
    $getStand = "SELECT teamName AS \"Team\", wins AS \"W\", losses AS \"L\", wins
                           / ( wins + losses ) AS \"Pct.\"	FROM Team ORDER BY wins / ( wins +
                           losses ) DESC";
    
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
    
    echo "<h3><a href=\"standings.php\">Team-by-team</a> | <a href=\"standings2.php\">Games by Date</a> | <b>Leaderboards</b></h3><br><br>";
    
    $myForm = '<form action="standings3.php" method="post">
                           Choose a leaderboard:
                           <select name="chart">
                           <option value="avg">Highest Average</option>
                           <option value="game">Best Game</option>
                           </select><br>
                           Max results to display: <input type="text" name="maxNum"><br>
                           Order: <br>
                           <input type="radio" name="order" value="desc" checked>Descending<br>
                           <input type="radio" name="order" value="asc">Ascending<br>
                           <input type="submit" value="Fetch Info">
                           <input type="hidden" name="formSubmitted" value="true">
                           </form>';
    
    if (isset($_POST["formSubmitted"])) {
        $whichForm  = $_POST['chart'];
        $whichOrder = $_POST['order'];
        
        $avg        = array();
        $bestPlayer = array();
        $bestGame   = array();
        
        for ($t = 1; $t <= 4; $t++) {
            
            $getTeam = "SELECT teamName, player1, player2, player3
                           FROM Team WHERE Team.teamKey =" . $t . " UNION 
                           SELECT teamGameNum, p1score, p2score, p3score FROM TeamGame
                           WHERE TeamGame.teamKey =" . $t;
            
            $teamResult = mysql_query($getTeam);
            $headerRow  = mysql_fetch_row($teamResult);
            
            $array1 = array();
            $array2 = array();
            $array3 = array();
            
            while ($row = mysql_fetch_array($teamResult)) {
                $array1[] = $row[1];
                $array2[] = $row[2];
                $array3[] = $row[3];
            }
            
            for ($i = 1; $i <= 3; $i++) {
                $playerName = $headerRow[$i];
                $player     = ${"array" . $i};
                if ($whichForm == "avg") {
                    $avgScore         = round(array_sum($player) / count($player));
                    $avg[$playerName] = $avgScore;
                } else {
                    for ($j = 0; $j < count($player); $j++) {
                        $bestPlayer[] = $playerName;
                        $bestGame[]   = $player[$j];
                    }
                }
            }
        }
        
        if ($whichForm == "avg") {
            if ($whichOrder == "desc") {
                arsort($avg);
            } else if ($whichOrder == "asc") {
                asort($avg);
            }
            
            echo "<TABLE id=\"standings\" BORDER=\"5\" WIDTH=\"50%\"
                           CELLPADDING=\"4\"
                           CELLSPACING=\"3\">
                           <tr align=\"center\">
                           			<td COLSPAN=\"3\"><H4>Average Scores</H4>
                           	 	</td>
                           </tr>";
            
            $itemCounter = 1;
            
            foreach ($avg as $key => $val) {
                if ($itemCounter <= ($_POST['maxNum'])) {
                    echo "<tr align=\"center\">";
                    echo "<td>" . $itemCounter . "</td>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>" . $val . "</td>";
                    echo "</tr>";
                    $itemCounter++;
                }
            }
            
            echo "</table><br><br>";
            echo $myForm;
        } else {
            
            echo "<TABLE id=\"standings\" BORDER=\"5\" WIDTH=\"50%\"
                           CELLPADDING=\"4\"
                           CELLSPACING=\"3\">
                           <tr align=\"center\">
                           			<td COLSPAN=\"3\"><H4>Single-Game Scores</H4>
                           	 	</td>
                           </tr>";
            
            if (($_POST['maxNum']) > count($bestGame)) {
                $counter = count($bestGame);
            } else {
                $counter = ($_POST['maxNum']);
            }
            
            for ($i = 1; $i <= $counter; $i++) {
                if ($whichOrder == "desc") {
                    $maxGame   = max($bestGame);
                    $gameKey   = array_search($maxGame, $bestGame);
                    $maxPlayer = $bestPlayer[$gameKey];
                    unset($bestGame[$gameKey]);
                    unset($bestPlayer[$gameKey]);
                    
                    echo "<tr align=\"center\">";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $maxPlayer . "</td>";
                    echo "<td>" . $maxGame . "</td>";
                    echo "</tr>";
                } else if ($whichOrder == "asc") {
                    $minGame   = min($bestGame);
                    $gameKey   = array_search($minGame, $bestGame);
                    $minPlayer = $bestPlayer[$gameKey];
                    unset($bestGame[$gameKey]);
                    unset($bestPlayer[$gameKey]);
                    
                    echo "<tr align=\"center\">";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $minPlayer . "</td>";
                    echo "<td>" . $minGame . "</td>";
                    echo "</tr>";
                }
            }
            
            echo "</table><br><br>";
            echo $myForm;
        }
        
        
        
    } else {
        echo $myForm;
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