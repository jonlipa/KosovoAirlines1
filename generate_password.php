<?php
$password = "admin"; 
echo password_hash($password, algo: PASSWORD_DEFAULT);
?>