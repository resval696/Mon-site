-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gymnova_db;
USE gymnova_db;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'member') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des abonnements
CREATE TABLE IF NOT EXISTS subscriptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    duration INT NOT NULL, -- durée en jours
    features TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des services
CREATE TABLE IF NOT EXISTS services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des témoignages
CREATE TABLE IF NOT EXISTS testimonials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    content TEXT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table des messages de contact
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'read', 'replied') DEFAULT 'new'
);

-- Insertion des données de base pour les abonnements
INSERT INTO subscriptions (name, description, price, duration, features) VALUES
('Basic', 'Accès aux équipements de base', 15000, 30, 'Accès aux équipements de base\nAccès aux vestiaires\nEau minérale gratuite'),
('Premium', 'Accès complet avec coaching', 25000, 30, 'Tous les avantages Basic\nCoaching personnel\nAccès aux cours collectifs\nSauna'),
('VIP', 'Expérience complète', 35000, 30, 'Tous les avantages Premium\nAccès illimité\nProgramme personnalisé\nMassage mensuel');

-- Insertion des données de base pour les services
INSERT INTO services (name, description, image_url) VALUES
('Musculation', 'Salle équipée des dernières machines de musculation', 'images/musculation.jpg'),
('Cardio', 'Espace cardio avec tapis roulants et vélos', 'images/cardio.jpg'),
('Yoga', 'Cours de yoga pour tous les niveaux', 'images/yoga.jpg'),
('CrossFit', 'Entraînement fonctionnel intensif', 'images/crossfit.jpg');

-- Création d'un utilisateur admin par défaut (mot de passe: admin123)
INSERT INTO users (username, password, email, full_name, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@gymnova.tg', 'Administrateur', 'admin'); 