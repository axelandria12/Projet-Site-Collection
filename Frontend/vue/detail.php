<?php
// Inclusion du fichier contenant les données (tableau $items)
include 'data.php';

// Récupère l'identifiant passé dans l'URL (ex: detail.php?id=3), ou null s'il est absent
$id = $_GET['id'] ?? null;

// Initialisation de la variable qui contiendra l'objet trouvé
$item = null;

// Parcours de tous les objets pour trouver celui avec l'ID correspondant
foreach ($items as $i) {
  if ($i['id'] == $id) {
    $item = $i; // Objet trouvé
    break; // On arrête la boucle
  }
}

// Si aucun objet n'est trouvé, on affiche un message d'erreur et on arrête l'exécution
if (!$item) {
  echo "Objet introuvable.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Détail - <?= htmlspecialchars($item['name']) ?></title>
  <style>
    /* Styles de base de la page */
    body {
      background-color: #0f172a; /* Fond sombre */
      color: #f8fafc; /* Texte clair */
      font-family: sans-serif;
      padding: 40px;
    }

    /* Conteneur centré avec fond contrasté */
    .container {
      max-width: 600px;
      margin: auto;
      background: #1e293b;
      padding: 20px;
      border-radius: 10px;
    }

    /* Image de l'objet */
    img {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
      border-radius: 10px;
    }

    /* Titre avec une couleur de mise en valeur */
    h2 {
      margin-top: 20px;
      color: #38bdf8;
    }

    /* Paragraphes avec marges */
    p {
      margin: 10px 0;
    }

    /* Style pour le tag (catégorie ou thème de l'objet) */
    .tag {
      background: #0ea5e9;
      padding: 5px 10px;
      border-radius: 6px;
      display: inline-block;
      color: white;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Affichage de l'image de l'objet -->
    <img src="<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">

    <!-- Titre de l'objet -->
    <h2><?= htmlspecialchars($item['name']) ?></h2>

    <!-- Informations descriptives -->
    <p><?= htmlspecialchars($item['info']) ?></p>

    <!-- Note attribuée à l'objet -->
    <p><strong>Note :</strong> <?= $item['note'] ?></p>

    <!-- Avis sur l'objet -->
    <p><strong>Avis :</strong> <?= htmlspecialchars($item['avis']) ?></p>

    <!-- Tag ou catégorie -->
    <p><strong>Tag :</strong> <span class="tag"><?= htmlspecialchars($item['tag']) ?></span></p>

    <!-- Lien de retour à la page principale -->
    <a href="Collection.php" style="color:#0ea5e9;">← Retour</a>
  </div>
</body>
</html>
