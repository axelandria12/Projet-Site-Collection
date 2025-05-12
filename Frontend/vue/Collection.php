<?php
// ------------------------------------------
// Liste des objets de la collection
// Chaque objet a un id, un nom, une image, une description (info) et un tag (catégorie)
// ------------------------------------------
$items = [
  ["id" => 1, "name" => "Kaiser", "img" => "images/kaiser1.jpg", "info" => "Kaiser is love", "tag" => "mangas"],
  ["id" => 2, "name" => "Kaiser!", "img" => "images/kaiser2.jpg", "info" => "Kaiser le goat", "tag" => "mangas"],
  ["id" => 3, "name" => "Mario", "img" => "images/kaiser3.jpg", "info" => "Jeu rétro classique", "tag" => "jeux"],
  ["id" => 4, "name" => "Dark Magician", "img" => "images/kaiser4.jpg", "info" => "Carte rare", "tag" => "cartes"]
];

// ------------------------------------------
// Suppression d’un objet via POST
// Si un formulaire a été soumis avec un champ 'delete', on supprime l'objet correspondant
// ------------------------------------------
if (isset($_POST['delete'])) {
    $deleteIndex = (int) $_POST['delete']; // Récupère l'index à supprimer
    unset($items[$deleteIndex]); // Supprime l’élément du tableau
    $items = array_values($items); // Réindexe le tableau pour éviter les trous dans les index
}

// ------------------------------------------
// Filtrage des objets par tag via GET
// Si aucun tag n’est sélectionné, on affiche tous les objets
// ------------------------------------------
$selectedTag = $_GET['tag'] ?? 'all'; // Tag sélectionné ou 'all' par défaut
$filteredItems = $selectedTag === 'all' ? $items : array_filter($items, fn($i) => $i['tag'] === $selectedTag);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Collecthor - Collection</title>
  <style>
    /* Style général de la page */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      height: 100vh;
      background: linear-gradient(to bottom, #0f172a, #1e293b);
      color: #f1f5f9;
    }
    /* Barre latérale (sidebar) */
    .sidebar {
      width: 220px;
      background: #1e293b;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
      border-right: 2px solid #334155;
    }
    .logo-img {
      width: 100%;
      max-width: 180px;
      margin-bottom: 10px;
      filter: drop-shadow(0 0 10px #38bdf8);
    }
    .sidebar select,
    .sidebar button {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      background-color: #0ea5e9;
      border: none;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 5px;
    }
    /* Section principale */
    .main {
      flex: 1;
      padding: 20px;
    }
    .header {
      font-size: 28px;
      font-weight: bold;
      color: #e0f2fe;
      text-shadow: 1px 1px 3px #0ea5e9;
      margin-bottom: 20px;
    }
    /* Grille des objets */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 20px;
    }
    .grid-item {
      background: #334155;
      padding: 10px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(56, 189, 248, 0.3);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .grid-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 15px rgba(56, 189, 248, 0.6);
    }
    .grid-item img {
      width: 100%;
      height: 100px;
      object-fit: cover;
      border-radius: 6px;
      margin-bottom: 8px;
    }
    a {
      text-decoration: none;
      color: inherit;
      display: block;
      padding: 10px;
      background: #38bdf8;
      border-radius: 6px;
      transition: background-color 0.3s, color 0.3s;
      margin-bottom: 10px;
    }
    a:hover {
      background-color: #0ea5e9;
      color: #f8fafc;
    }
    form {
      display: inline;
    }
  </style>
</head>
<body>

  <!-- Barre latérale avec filtres et actions -->
  <div class="sidebar">
    <!-- Logo de l'application -->
    <img src="images/collecthor.png" alt="Logo" class="logo-img">

    <!-- Formulaire pour filtrer les objets par tag -->
    <form method="get">
      <select name="tag" onchange="this.form.submit()">
        <option value="all" <?= $selectedTag === 'all' ? 'selected' : '' ?>>Tous les tags</option>
        <option value="cartes" <?= $selectedTag === 'cartes' ? 'selected' : '' ?>>Cartes à collectionner</option>
        <option value="figurines" <?= $selectedTag === 'figurines' ? 'selected' : '' ?>>Figurines</option>
        <option value="jeux" <?= $selectedTag === 'jeux' ? 'selected' : '' ?>>Jeux rétro</option>
        <option value="mangas" <?= $selectedTag === 'mangas' ? 'selected' : '' ?>>Mangas</option>
      </select>
    </form>

    <!-- Liens vers autres fonctionnalités -->
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

  <!-- Contenu principal -->
  <div class="main">
    <div class="header">Ma Collection</div>

    <!-- Affichage des objets filtrés -->
    <div class="grid">
      <?php foreach ($filteredItems as $index => $item): ?>
        <div class="grid-item">
          <!-- Lien vers la page de détail de l'objet -->
          <a href="detail.php?id=<?= $item['id'] ?>">
            <img src="<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
            <strong><?= htmlspecialchars($item['name']) ?></strong><br>
            <small><?= htmlspecialchars($item['info']) ?></small><br>
            <small><em>(<?= htmlspecialchars($item['tag']) ?>)</em></small>
          </a>

          <!-- Formulaire de suppression de l’objet -->
          <form method="post" onsubmit="return confirm('Confirmer la suppression de <?= addslashes($item['name']) ?> ?');">
            <input type="hidden" name="delete" value="<?= $index ?>">
            <button type="submit">Supprimer</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>
</html>
