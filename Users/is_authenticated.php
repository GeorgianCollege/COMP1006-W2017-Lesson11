<?php
    if(!isset($_SESSION["is_logged_in"])) {
        // if everything good go to index page
        header('Location: index.php?pageId=Login');
    }
?>