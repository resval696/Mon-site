<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

// Récupération des services
$stmt = $conn->query("SELECT * FROM services ORDER BY id LIMIT 4");
$services = $stmt->fetchAll();

// Récupération des témoignages
$stmt = $conn->query("SELECT t.*, u.full_name FROM testimonials t 
                     LEFT JOIN users u ON t.user_id = u.id 
                     ORDER BY t.created_at DESC LIMIT 3");
$testimonials = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gymnova - Votre salle de sport à Lomé</title>
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
                <?php if (isLoggedIn()): ?>
                    <?php if (isAdmin()): ?>
                        <li><a href="admin.php">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="login.php">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Bienvenue chez Gymnova</h1>
            <p>Votre partenaire fitness à Lomé</p>
            <a href="subscription.php" class="cta-button">Rejoignez-nous</a>
        </section>

        <section class="services">
            <h2>Nos Services</h2>
            <div class="service-grid">
                <?php foreach ($services as $service): ?>
                    <div class="service-card">
                        <img src="<?php echo htmlspecialchars($service['image_url']); ?>" alt="<?php echo htmlspecialchars($service['name']); ?>">
                        <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="testimonials">
            <h2>Témoignages</h2>
            <div class="testimonial-grid">
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="testimonial-card">
                        <p><?php echo htmlspecialchars($testimonial['content']); ?></p>
                        <h4><?php echo htmlspecialchars($testimonial['full_name']); ?></h4>
                        <div class="stars">
                            <?php echo str_repeat('★', $testimonial['rating']) . str_repeat('☆', 5 - $testimonial['rating']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
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