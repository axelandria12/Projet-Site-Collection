<?php
// Définition des paramètres de connexion à la base de données
$host = '127.0.0.1';  // Adresse de l'hôte (localhost)
$dbname = 'site collection';  // Nom de la base de données
$user = 'root';  // Nom d'utilisateur pour se connecter à la base de données
$pass = '';  // Mot de passe de l'utilisateur (vide dans cet exemple)

// Tentative de connexion à la base de données avec gestion des erreurs
try {
    // Création de l'objet PDO pour se connecter à la base de données avec les paramètres définis ci-dessus
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    
    // Configuration de PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si une erreur survient pendant la connexion, on affiche un message d'erreur et on arrête le script
    die("Erreur : " . $e->getMessage());
}

// Initialisation d'un tableau vide pour stocker les objets récupérés
$items = [];

// Exécution de la requête SQL pour récupérer tous les objets dans la table "item"
$stmt = $pdo->query("SELECT * FROM item");

// Parcours de chaque ligne retournée par la requête
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Ajout des objets récupérés dans le tableau $items sous forme de tableau associatif
    $items[] = [
        'id' => $row['n°item'],  // ID de l'objet (clé primaire)
        'name' => $row['nom item'],  // Nom de l'objet
        'info' => $row['descitem'],  // Description de l'objet
        'note' => $row['noteitem'],  // Note de l'objet
        'avis' => $row['avisitem'],  // Avis associé à l'objet
        'tag' => $row['tag'],  // Tag de l'objet (type de collection, ex: figurines, cartes, etc.)
        'img' => $row['image item'],  // URL ou chemin de l'image de l'objet
    ];
}
?>
