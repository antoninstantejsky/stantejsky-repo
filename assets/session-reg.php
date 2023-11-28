<?php

session_start();

function regenerate() {
    $_SESSION['code'] = uniqid();
    $_SESSION['code_time'] = time();
}

if (empty($_SESSION['code']) || time() - $_SESSION['code_time'] > 100)
regenerate();
 
echo "váš uživatelský kód je" ." ". $_SESSION['code'] ." ". "vyprší v" . date(' h:i:s a m/d/Y ', $_SESSION['code_time']+100);

?>