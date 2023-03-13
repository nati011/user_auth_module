<?php
    $pdo_authentication= new pdo('mysql:host=localhost; port=3306; dbname=authentication', 'nati', 'zap');
    $pdo_authentication->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>