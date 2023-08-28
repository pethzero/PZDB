<?php
$host = '192.168.1.205';
$db_name = 'SAN';
$username = 'root';
$password = '1234';

try {
    $pdo = new PDO("mysql:host=$host;port=33061;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>