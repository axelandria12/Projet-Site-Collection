<?php
$host = 'db';
$db = 'demo';
$user = 'user';
$pass = 'password';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>