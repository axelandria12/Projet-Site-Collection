<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0e1a2b; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #12233a;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }

        .login-container img {
            display: block;
            margin: 0 auto 20px auto;
            width: 180px; 
        }

        .login-container h1 {
            color: #f0f0f0;
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
        }

        label {
            color: #ccc;
            display: block;
            margin: 15px 0 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #1f2f47;
            color: #f0f0f0;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>

        <form action="votre_action.php" method="post">
            <label for="email">Email ou pseudo</label>
            <input type="text" id="email" name="email" placeholder="Email de connexion ou pseudo" required />

            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required />

            <input type="submit" value="Se connecter" />
        </form>
    </div>
</body>
</html>