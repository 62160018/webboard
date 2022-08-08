<?php
    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'webboard');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);

        $connection->exec("SET NAMES utf8");
        $connection->exec("SET CHARACTER SET utf8");
        $connection->exec("SET CHARACTER_SET_CONNECTION=utf8");

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

date_default_timezone_set('Asia/Bangkok');