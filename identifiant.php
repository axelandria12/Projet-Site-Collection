<?php
// Paramètres de connexion
$host = 'db'; // Nom du service MySQL dans Docker
$dbname = 'demo'; // Nom de la base de données
$username = 'user'; // Nom d'utilisateur
$password = 'password'; // Mot de passe

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Définir le mode d'erreur de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connexion réussie à la base de données '$dbname' !";
} catch (PDOException $e) {
    // Si une erreur se produit, afficher le message
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
