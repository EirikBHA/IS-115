<?php
session_start();

// Slette session
session_destroy();

session_start();
$_SESSION["logout"] = "Du ble logget ut";

// Redirect til login page
header("Location: login.php");
exit();
?>
