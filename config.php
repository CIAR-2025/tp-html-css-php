<?php
$serveur = "127.0.0.1";
$utilisateur = "root";
$mot_de_passe = "root";
$base_de_donnees = "enseignant_db";

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8",
        $utilisateur, $mot_de_passe);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Création des tables si elles n'existent pas
$sql_contacts = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenoms VARCHAR(100) NOT NULL,
    nom VARCHAR(100),
    email VARCHAR(150) NOT NULL,
    telephone VARCHAR(12),
    objet VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$sql_matieres = "CREATE TABLE IF NOT EXISTS matieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_matiere VARCHAR(100) NOT NULL,
    classe_niveau VARCHAR(50) NOT NULL,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$pdo->exec($sql_contacts);
$pdo->exec($sql_matieres);
?>