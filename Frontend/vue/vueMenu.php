<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ma Collection avec Menu Spoiler</title>
  <style>
    :root {
      --main-color: #220c90;
      --text-light: #fff;
      --border-radius: 16px;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    * {
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      color: #333;
      display: flex;
      flex-direction: column;
    }

    header {
      background-color: var(--main-color);
      color: var(--text-light);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      flex-wrap: wrap;
    }

    .logo img {
      width: 60px;
      height: 60px;
      border-radius: var(--border-radius);
      object-fit: cover;
    }

    .search-bar {
      flex: 1;
      text-align: center;
      margin: 10px;
    }

    .search-bar input {
      width: 100%;
      max-width: 500px;
      padding: 10px 16px;
      border-radius: var(--border-radius);
      border: none;
      font-size: 16px;
      outline: none;
    }

    .profile form {
      margin: 0;
    }

    .login-button {
      padding: 10px 20px;
      border: none;
      border-radius: var(--border-radius);
      background-color: #fff;
      color: var(--main-color);
      font-weight: bold;
      cursor: pointer;
      box-shadow: var(--shadow);
      transition: background-color 0.3s, color 0.3s;
    }

    .login-button:hover {
      background-color: #e5e5e5;
      color: #000;
    }

    main {
      display: flex;
      flex-wrap: wrap;
      padding: 20px;
      flex: 1;
    }

    .collection {
      flex: 1;
      background-color: white;
      border-radius: 40px;
      padding: 20px;
      margin-right: 20px;
      margin-bottom: 20px;
      box-shadow: var(--shadow);
    }

    .collection h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
    }

    .objet img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: var(--border-radius);
      border: 2px solid black;
      box-shadow: var(--shadow);
    }

    .side-panel {
      width: 250px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .collection-btn {
      border: 2px solid black;
      border-radius: var(--border-radius);
      padding: 20px;
      text-align: center;
      background-color: white;
      box-shadow: var(--shadow);
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .collection-btn:hover {
      background-color: #e5e5e5;
    }

    .image-box img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 30px;
      border: 2px solid black;
      box-shadow: var(--shadow);
    }

    footer {
      background-color: var(--main-color);
      height: 50px;
    }

    #spoiler-toggle {
      display: none;
    }

    .spoiler-label {
      position: absolute;
      top: 80px;
      left: 10px;
      width: 30px;
      height: 30px;
      background-color: transparent;
      cursor: pointer;
      z-index: 10;
    }

    .spoiler-label::after {
      content: "→";
      color: var(--main-color);
      font-size: 40px;
      position: absolute;
      left: 8px;
    }

    aside {
      position: fixed;
      top: 0;
      left: -200px;
      width: 200px;
      height: 100%;
      background-color: #eee;
      border-right: 2px solid #ccc;
      padding: 20px;
      transition: left 0.3s ease;
      z-index: 5;
    }

    #spoiler-toggle:checked ~ aside {
      left: 0;
    }

    #spoiler-toggle:checked + .spoiler-label::after {
      content: "←";
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: center;
      }

      .search-bar {
        width: 100%;
        margin: 10px 0;
      }

      main {
        flex-direction: column;
      }

      .collection {
        margin-right: 0;
      }

      .side-panel {
        width: 100%;
        flex-direction: row;
        justify-content: center;
      }

      .collection-btn,
      .image-box {
        flex: 1;
        max-width: 48%;
      }
    }

    @media (max-width: 480px) {
      .side-panel {
        flex-direction: column;
      }

      .collection-btn,
      .image-box {
        max-width: 100%;
      }

      .spoiler-label {
        top: 100px;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">
      <img src="../images/collecthor.png" alt="Logo">
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Rechercher dans ma collection...">
    </div>
    <div class="profile">
      <form action="vueConnexion.php" method="post">
        <button type="submit" class="login-button">Connexion</button>
      </form>
    </div>
  </header>

  <input type="checkbox" id="spoiler-toggle">
  <label for="spoiler-toggle" class="spoiler-label" title="Afficher le menu"></label>

  <aside>
    <h3>Menu latéral</h3>
    <ul>
      <li><a href="#">Lien 1</a></li>
      <li><a href="#">Lien 2</a></li>
      <li><a href="#">Lien 3</a></li>
    </ul>
  </aside>

  <main>
    <div class="collection">
      <h2>Collection</h2>
      <div class="grid">
        <div class="objet"><img src="../images/test.png" alt="objet 1"></div>
        <div class="objet"><img src="../images/test.png" alt="objet 2"></div>
        <div class="objet"><img src="../images/test.png" alt="objet 3"></div>
        <div class="objet"><img src="../images/test.png" alt="objet 4"></div>
        <div class="objet"><img src="../images/test.png" alt="objet 5"></div>
        <div class="objet"><img src="../images/test.png" alt="objet 6"></div>
      </div>
    </div>

    <div class="side-panel">
      <a href="Collection.php" class="collection-btn">Ma collection</a>
      <div class="image-box">
        <img src="../images/test.png" alt="Publicité">
      </div>
    </div>
  </main>

  <footer></footer>

</body>
</html>
