<?php
// Connexion à la base de données avec PDO
$pdo = new PDO('mysql:host=localhost;dbname=site collection;charset=utf8mb4', 'root', '');

// Récupération du tag sélectionné à partir de la requête GET, avec une valeur par défaut 'all'
$selectedTag = $_GET['tag'] ?? 'all';

// Préparation de la requête SQL en fonction du tag sélectionné
if ($selectedTag === 'all') {
    // Si aucun tag spécifique n'est sélectionné, on récupère tous les objets
    $stmt = $pdo->prepare("SELECT * FROM item");
    $stmt->execute();
} else {
    // Si un tag est sélectionné, on récupère uniquement les objets associés à ce tag
    $stmt = $pdo->prepare("SELECT * FROM item WHERE `tag` = :tag");
    $stmt->execute(['tag' => $selectedTag]);
}

// Récupération de tous les objets depuis la base de données sous forme de tableau associatif
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Collecthor - Collection</title>
  <!-- Lien vers le fichier CSS externe pour le style -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Barre latérale contenant le logo et les filtres -->
  <div class="sidebar">
    <!-- Affichage du logo -->
    <img src="images/collecthor.png" alt="Logo" class="logo-img">

    <!-- Formulaire pour sélectionner un tag de filtrage -->
    <form method="get">
      <select name="tag" onchange="this.form.submit()"> <!-- Envoi automatique du formulaire lors de la sélection -->
        <!-- Options de tags avec la mise en surbrillance du tag sélectionné -->
        <option value="all" <?= $selectedTag === 'all' ? 'selected' : '' ?>>Tous les tags</option>
        <option value="cartes" <?= $selectedTag === 'cartes' ? 'selected' : '' ?>>Cartes à collectionner</option>
        <option value="figurines" <?= $selectedTag === 'figurines' ? 'selected' : '' ?>>Figurines</option>
        <option value="jeux" <?= $selectedTag === 'jeux' ? 'selected' : '' ?>>Jeux rétro</option>
        <option value="mangas" <?= $selectedTag === 'mangas' ? 'selected' : '' ?>>Mangas</option>
      </select>
    </form>

    <!-- Formulaires pour ajouter, supprimer et modifier des objets -->
    <form action="ajouter.php" method="post">
      <button type="submit">Ajouter</button>
    </form>
    <form action="supprimer.php" method="post">
      <button type="submit">Supprimer</button>
    </form>
    <form action="modifier.php" method="post">
      <button type="submit">Modifier</button>
    </form>
  </div>

  <!-- Contenu principal de la page -->
  <div class="main">
    <div class="header">Ma Collection</div>
    <div class="grid">
      <!-- Boucle pour afficher chaque objet dans la collection -->
      <?php foreach ($items as $item): ?>
        <div class="grid-item">
          <!-- Lien vers la page de détails de l'objet -->
          <a href="detail.php?id=<?= $item['n°item'] ?>">
            <!-- Affichage de l'image de l'objet -->
            <img src="<?= htmlspecialchars($item['image item']) ?>" alt="<?= htmlspecialchars($item['nom item']) ?>">
            <!-- Nom de l'objet -->
            <strong><?= htmlspecialchars($item['nom item']) ?></strong><br>
            <!-- Description courte de l'objet -->
            <small><?= htmlspecialchars($item['descitem']) ?></small><br>
            <!-- Affichage du tag associé à l'objet -->
            <small><em>(<?= htmlspecialchars($item['tag']) ?>)</em></small>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>
</html>
