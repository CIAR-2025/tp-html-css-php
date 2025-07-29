-- Création de la base de données
CREATE DATABASE IF NOT EXISTS enseignant_db
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE enseignant_db;

-- Table des contacts
CREATE TABLE IF NOT EXISTS contacts (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        prenoms VARCHAR(100) NOT NULL,
                                        nom VARCHAR(100),
                                        email VARCHAR(150) NOT NULL,
                                        telephone VARCHAR(12),
                                        objet VARCHAR(200) NOT NULL,
                                        message TEXT NOT NULL,
                                        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                        INDEX idx_date (date_creation),
                                        INDEX idx_email (email)
);

-- Table des matières
CREATE TABLE IF NOT EXISTS matieres (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        nom_matiere VARCHAR(100) NOT NULL,
                                        classe_niveau VARCHAR(50) NOT NULL,
                                        date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                        INDEX idx_matiere (nom_matiere),
                                        INDEX idx_niveau (classe_niveau)
);

-- Insertion de données d'exemple
INSERT INTO matieres (nom_matiere, classe_niveau) VALUES
                                                      ('Mathématiques', 'Terminale S'),
                                                      ('Physique', '1ère S'),
                                                      ('Chimie', '2nde'),
                                                      ('Algèbre', 'L1'),
                                                      ('Mécanique', 'Terminale S');