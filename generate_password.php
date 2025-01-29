<?php
$password = "admin"; // Vendos këtu fjalëkalimin që dëshiron
echo password_hash($password, algo: PASSWORD_DEFAULT);
?>
