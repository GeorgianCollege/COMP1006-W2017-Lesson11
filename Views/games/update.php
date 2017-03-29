<?php
include_once('Users/is_authenticated.php');
include_once('Config/database.php');
include_once('Controllers/games.php');

$isAddition = filter_input(INPUT_POST, "isAddition");
$gameName = filter_input(INPUT_POST, "NameTextField"); //$_POST["NameTextField"];
$gameCost = filter_input(INPUT_POST, "CostTextField"); //$_POST["CostTextField"];

if($isAddition == "1") {
 CreateGame($gameName, $gameCost);
}
else {
 $gameID = filter_input(INPUT_POST, "IDTextField"); // $_POST["IDTextField"];
 UpdateGame($gameID, $gameName, $gameCost);
}

// redirect to index page
header('Location: index.php?pageId=GamesList');
?>
