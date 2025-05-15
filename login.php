<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (login($username, $password)) {
        header('Location: index.php');
        exit();
    } else {
        $error = 'Nom d\'utilisateur ou mot de passe incorrect';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gymnova</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Gymnova</div>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="subscription.php">Abonnements</a></li>
                <li><a href="about.php">À propos</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="login-container">
        <div class="login-form">
            <h2>Connexion</h2>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Se connecter</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Horaires d'ouverture</h3>
                <p>Lundi - Vendredi: 6h00 - 22h00</p>
                <p>Samedi: 7h00 - 20h00</p>
                <p>Dimanche: 8h00 - 18h00</p>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: contact@gymnova.tg</p>
                <p>Tél: +228 90 00 00 00</p>
                <p>Adresse: Lomé, Togo</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Gymnova. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html> 