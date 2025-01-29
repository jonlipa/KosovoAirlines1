<?php
session_start();

// Mbyll të gjitha variablat e sesionit
session_unset();

// Shkatërro sesionin
session_destroy();

// Shto header për të ndaluar cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirektohu në faqen e login-it ose kryesore
header("Location: login.php?message=" . urlencode("You have been successfully logged out."));
exit();
?>