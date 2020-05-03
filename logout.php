<?php require_once("includes/header.php"); ?>

<?php

    $session->logout();
    header("Location: index.php");
    
?>