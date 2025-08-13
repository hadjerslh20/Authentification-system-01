<?php
    $host="localhost";
    $db="auth-sys";
    $user="root";
    $password="";
    $dsn ="mysql:host=$host;dbname=$db;Charset=UTF8 ";

    try {
        return $pdo= new PDO($dsn,$user,$password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }catch(PDOException $e) {
        echo $e->getMessage();
    }finally {
        
    }