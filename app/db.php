<?php
declare(strict_types=1);

if(!defined('APP_ENV') || !defined('DB_LINK')){
    throw new RuntimeException("Config.php fájlt be kell tölteni!");
}

function db() : PDO{
    $pdo = new PDO('sqlite:' . DB_LINK);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    return $pdo;
}



?>