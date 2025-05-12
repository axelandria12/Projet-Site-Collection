<?php
// Connexion à la base de données avec PDO
$pdo = new PDO('mysql:host=localhost;dbname=site collection;charset=utf8mb4', 'root', '');

// Vérification si un ID a été passé dans l'URL
if (!isset($_GET['id'])) {
    // Si aucun ID n'est fourni, on arrête le script et affiche un message d'erreur
    die('Aucun identifiant fourni.');
}

// Récupération de l'ID passé dans l'URL, et on le transforme en entier pour éviter les failles de sécurité
$id = (int) $_GET['id'];

// Préparation de la requête SQL pour récupérer l'objet correspondant à l'ID
$stmt = $pdo->prepare("SELECT * FROM item WHERE `n°item` = :id");
// Exécution de la requête avec l'ID passé en paramètre
$stmt->execute(['id' => $id]);

// Récupération du résultat sous forme de tableau associatif
$item = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification si l'objet a été trouvé
if (!$item) {
    // Si l'objet n'a pas été trouvé, on affiche un message d'erreur
    die("Item non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détail de l'objet</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Style de la section de détail de l'objet */
    .detail {
      max-width: 600px;
      margin: 40px auto;
      background-color: #1e293b; /* Fond sombre */
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(56, 189, 248, 0.3); /* Ombre douce autour de la boîte */
      text-align: center;
      color: #f1f5f9; /* Texte clair */
    }

    /* Style de l'image de l'objet */
    .detail img {
      width: 100%;
      max-height: 300px;
      object-fit: cover; /* Garde le ratio de l'image sans la déformer */
      border-radius: 8px;
      margin-bottom: 20px; /* Espacement sous l'image */
    }

    /* Style du titre (nom de l'objet) */
    .detail h1 {
      margin-bottom: 10px;
      color: #38bdf8; /* Couleur bleue pour le titre */
    }

    /* Style des paragraphes d'information sur l'objet */
    .detail p {
      margin-bottom: 5px;
    }

    /* Style du lien pour revenir à la collection */
    .back-link {
      display: inline-block;
      margin-top: 20px;
      background: #38bdf8; /* Fond bleu pour le lien */
      padding: 10px 15px;
      color: white;
      border-radius: 6px;
      text-decoration: none; /* Retirer le soulignement du lien */
    }

    /* Effet de survol du lien */
    .back-link:hover {
      background: #0ea5e9; /* Changer la couleur du fond lors du survol */
    }
  </style>
</head>
<body>

  <div class="detail">
    <!-- Affichage de l'image de l'objet avec une balise HTML sécurisée pour éviter les injections XSS -->
    <img src="<?= htmlspecialchars($item['image item']) ?>" alt="<?= htmlspecialchars($item['nom item']) ?>">
    
    <!-- Affichage du nom de l'objet -->
    <h1><?= htmlspecialchars($item['nom item']) ?></h1>
    
    <!-- Affichage de la description de l'objet -->
    <p><strong>Description :</strong> <?= htmlspecialchars($item['descitem']) ?></p>
    
    <!-- Affichage du tag de l'objet (catégorie) -->
    <p><strong>Tag :</strong> <?= htmlspecialchars($item['tag']) ?></p>
    
    <!-- Affichage de la note de l'objet sur 5 -->
    <p><strong>Note :</strong> <?= htmlspecialchars($item['noteitem']) ?>/5</p>
    
    <!-- Affichage des avis de l'objet -->
    <p><strong>Avis :</strong> <?= htmlspecialchars($item['avisitem']) ?></p>

    <!-- Lien pour revenir à la page de la collection -->
    <a href="collection.php" class="back-link">← Retour à la collection</a>
  </div>

</body>
</html>
