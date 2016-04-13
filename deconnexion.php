<?php
include 'inc/titre.php';
$_SESSION["user"] = NULL;
session_destroy();
header("location: gestion.php");