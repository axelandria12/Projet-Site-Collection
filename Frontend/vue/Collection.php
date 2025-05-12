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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collecthor - Collection</title>
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(to bottom, #0f172a, #1e293b);
  color: #f1f5f9;
  min-height: 100vh;
  padding: 20px;
  line-height: 1.4;
}

.header {
  font-size: 32px;
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

.top-bar form {
  display: flex;
}

select,
button {
  padding: 10px 14px;
  font-size: 15px;
  border: none;
  border-radius: 6px;
  background-color: #0ea5e9;
  color: white;
  cursor: pointer;
  transition: background 0.3s;
}

button:hover,
select:hover {
  background-color: #0284c7;
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 20px;
}

.grid-item {
  background: #334155;
  padding: 12px;
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
  height: 120px;
  object-fit: cover;
  border-radius: 6px;
  margin-bottom: 8px;
}

a {
  display: block;
  text-decoration: none;
  color: inherit;
  background: #38bdf8;
  padding: 10px;
  border-radius: 6px;
  margin-bottom: 10px;
  transition: background 0.3s;
}

a:hover {
  background-color: #0ea5e9;
  color: #f8fafc;
}

form {
  display: inline;
}

/* === Responsive Breakpoints === */

@media (max-width: 1024px) {
  .header {
    font-size: 28px;
  }

  select,
  button {
    font-size: 14px;
    padding: 9px 12px;
  }

  .grid-item img {
    height: 110px;
  }
}

@media (max-width: 768px) {
  .top-bar {
    flex-direction: column;
    align-items: center;
    gap: 15px;
  }

  .top-bar form {
    width: 100%;
    justify-content: center;
  }

  .grid {
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
  }

  .header {
    font-size: 24px;
  }
}

@media (max-width: 480px) {
  body {
    padding: 15px 10px;
  }

  .header {
    font-size: 20px;
  }

  select,
  button {
    width: 100%;
    font-size: 14px;
    padding: 10px;
  }

  .grid-item {
    padding: 10px;
  }

  .grid-item img {
    height: 100px;
  }

  a {
    padding: 8px;
    font-size: 14px;
  }
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
