<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thoth - LMS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 40px; }
        .buttons { text-align: center; }
        .btn { display: inline-block; padding: 10px 20px; margin: 10px; text-decoration: none; background: #007bff; color: white; border-radius: 5px; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenue sur Thoth LMS</h1>
            <p>Votre plateforme d'apprentissage en ligne</p>
        </div>
        <div class="buttons">
            <a href="<?php echo BASE_URL; ?>/login" class="btn">Se connecter</a>
            <a href="<?php echo BASE_URL; ?>/register" class="btn">S'inscrire</a>
        </div>
    </div>
</body>
</html>
