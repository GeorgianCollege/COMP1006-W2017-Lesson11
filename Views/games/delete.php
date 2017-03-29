<?php
include_once('Users/is_authenticated.php');
include_once('Config/database.php');
include_once('Controllers/games.php');

$gameID = $_GET["gameID"]; // assigns the gameID from the URL

if($gameID != false) {
    DeleteGame($gameID);
}

// redirect to index page
header('Location: index.php?pageId=GamesList');

?>