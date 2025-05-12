<?php
include 'data.php';
$id = $_GET['id'] ?? null;
$item = null;
foreach ($items as $i) {
  if ($i['id'] == $id) {
    $item = $i;
    break;
  }
}
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
    body {
      background-color: #0f172a;
      color: #f8fafc;
      font-family: sans-serif;
      padding: 40px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: #1e293b;
      padding: 20px;
      border-radius: 10px;
    }
    img {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
      border-radius: 10px;
    }
    h2 {
      margin-top: 20px;
      color: #38bdf8;
    }
    p {
      margin: 10px 0;
    }
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
    <img src="<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
    <h2><?= htmlspecialchars($item['name']) ?></h2>
    <p><?= htmlspecialchars($item['info']) ?></p>
    <p><strong>Note :</strong> <?= $item['note'] ?></p>
    <p><strong>Avis :</strong> <?= htmlspecialchars($item['avis']) ?></p>
    <p><strong>Tag :</strong> <span class="tag"><?= htmlspecialchars($item['tag']) ?></span></p>
    <a href="Collection.php" style="color:#0ea5e9;">← Retour</a>
  </div>
</body>
</html>
