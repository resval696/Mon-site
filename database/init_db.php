<?php
require_once '../config/database.php';

try {
    // Lecture du fichier SQL
    $sql = file_get_contents('gymnova_db.sql');
    
    // Exécution des requêtes SQL
    $conn->exec($sql);
    
    echo "Base de données initialisée avec succès !";
} catch(PDOException $e) {
    echo "Erreur lors de l'initialisation de la base de données : " . $e->getMessage();
}
?> 