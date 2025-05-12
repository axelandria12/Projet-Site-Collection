<?php
$items = [
  ["id" => 1, "name" => "Kaiser", "img" => "images/kaiser1.jpg", "info" => "Kaiser is love", "tag" => "mangas"],
  ["id" => 2, "name" => "Kaiser!", "img" => "images/kaiser2.jpg", "info" => "Kaiser le goat", "tag" => "mangas"],
  ["id" => 3, "name" => "Mario", "img" => "images/kaiser3.jpg", "info" => "Jeu rétro classique", "tag" => "jeux"],
  ["id" => 4, "name" => "Dark Magician", "img" => "images/kaiser4.jpg", "info" => "Carte rare", "tag" => "cartes"]
];

if (isset($_POST['delete'])) {
    $deleteIndex = (int) $_POST['delete'];
    unset($items[$deleteIndex]);
    $items = array_values($items);
}

$selectedTag = $_GET['tag'] ?? 'all';
$filteredItems = $selectedTag === 'all' ? $items : array_filter($items, fn($i) => $i['tag'] === $selectedTag);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Collecthor - Collection</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #0f172a, #1e293b);
      color: #f1f5f9;
      min-height: 100vh;
      padding: 20px;
    }
    .header {
      font-size: 28px;
      font-weight: bold;
      color: #e0f2fe;
      text-shadow: 1px 1px 3px #0ea5e9;
      margin-bottom: 20px;
      text-align: center;
    }
    .top-bar {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin-bottom: 30px;
    }
    .top-bar form,
    .top-bar select,
    .top-bar button {
      font-size: 14px;
    }
    select,
    button {
      padding: 10px;
      border: none;
      border-radius: 6px;
      background-color: #0ea5e9;
      color: white;
      cursor: pointer;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
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

  <div class="header">Ma Collection</div>

  <div class="top-bar">
    <form method="get">
      <select name="tag" onchange="this.form.submit()">
        <option value="all" <?= $selectedTag === 'all' ? 'selected' : '' ?>>Tous les tags</option>
        <option value="cartes" <?= $selectedTag === 'cartes' ? 'selected' : '' ?>>Cartes à collectionner</option>
        <option value="figurines" <?= $selectedTag === 'figurines' ? 'selected' : '' ?>>Figurines</option>
        <option value="jeux" <?= $selectedTag === 'jeux' ? 'selected' : '' ?>>Jeux rétro</option>
        <option value="mangas" <?= $selectedTag === 'mangas' ? 'selected' : '' ?>>Mangas</option>
      </select>
    </form>

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

  <div class="grid">
    <?php foreach ($filteredItems as $index => $item): ?>
      <div class="grid-item">
        <a href="detail.php?id=<?= $item['id'] ?>">
          <img src="<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
          <strong><?= htmlspecialchars($item['name']) ?></strong><br>
          <small><?= htmlspecialchars($item['info']) ?></small><br>
          <small><em>(<?= htmlspecialchars($item['tag']) ?>)</em></small>
        </a>
        <form method="post" onsubmit="return confirm('Confirmer la suppression de <?= addslashes($item['name']) ?> ?');">
          <input type="hidden" name="delete" value="<?= $index ?>">
          <button type="submit">Supprimer</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
