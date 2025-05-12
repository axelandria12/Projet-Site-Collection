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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détail - <?= htmlspecialchars($item['name']) ?></title>
  <style>
    body {
      background-color: #0f172a;
      color: #f8fafc;
      font-family: sans-serif;
      padding: 40px;
      margin: 0;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background: #1e293b;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(56, 189, 248, 0.1);
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
      font-size: 28px;
    }

    p {
      margin: 10px 0;
      font-size: 16px;
    }

    .tag {
      background: #0ea5e9;
      padding: 5px 10px;
      border-radius: 6px;
      display: inline-block;
      color: white;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #0ea5e9;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      body {
        padding: 20px;
      }

      .container {
        padding: 16px;
      }

      h2 {
        font-size: 24px;
      }

      p {
        font-size: 15px;
      }
    }

    @media (max-width: 480px) {
      body {
        padding: 10px;
      }

      .container {
        padding: 14px;
      }

      h2 {
        font-size: 20px;
      }

      p {
        font-size: 14px;
      }

      img {
        max-height: 200px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
    <h2><?= htmlspecialchars($item['name']) ?></h2>
    <p><?= htmlspecialchars($item['info']) ?></p>
    <p><strong>Note :</strong> <?= htmlspecialchars($item['note']) ?></p>
    <p><strong>Avis :</strong> <?= htmlspecialchars($item['avis']) ?></p>
    <p><strong>Tag :</strong> <span class="tag"><?= htmlspecialchars($item['tag']) ?></span></p>
    <a href="Collection.php">← Retour</a>
  </div>
</body>
</html>
