<?php

function getYear()
{
    echo date("Y");
}

function greetUser()
{
    
    date_default_timezone_set('America/Los_Angeles');
    
    $hour = date('G');
    
    switch ($hour) {
        case $hour < 12:
            echo "Good morning!";
            break;
        case $hour > 11 && $hour < 17:
            echo "Good afternoon!";
            break;
        case $hour > 17:
            echo "Good evening!";
            break;
        default:
            echo "Good day.";
    }
}

function makeHeader($link)
{
    $nav = array(
        'home' => "Home",
        'reg' => "Register",
        'stand' => "Standings",
        'con' => "Contact"
    );
    return $nav[$link];
}

function getSessionInfo()
{
    if (isset($_SESSION["username"])) {
        return "<a href=\"logout.php\">Log Out (" . ($_SESSION["username"]) . ")</a>";
    } else {
        return "<a href=\"index.php\">Not currently signed in.</a>";
    }
}

function getHits()
{
    if (!file_exists("hitcounter.txt")) {
        file_put_contents("hitcounter.txt", "1");
    } else {
        $count        = file_get_contents("hitcounter.txt");
        $count_to_int = ctype_digit($count) ? intval($count) : null;
        if ($count_to_int === null) {
            file_put_contents("hitcounter.txt", "1");
        } else {
            $count_to_int++;
            file_put_contents("hitcounter.txt", $count_to_int);
        }
    }
    
    return file_get_contents("hitcounter.txt");
}

?>