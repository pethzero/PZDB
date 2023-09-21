<?php
$host = '';
$db_name = '';
$username = '';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=33061;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>