<?php

// This gets called on Core/Database.php
return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'kyoo',
        'charset' => 'utf8mb4',
    ],
];

// $hostname = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'kyoo';

// try {
//     $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
