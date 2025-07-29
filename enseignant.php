<?php
global $pdo;
require_once 'config.php';

$message_confirmation = "";
$erreurs = [];

// Traitement de l'ajout de matière
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter_matiere'])) {
    $nom_matiere = trim(isset($_POST['nom_matiere']) ? $_POST['nom_matiere'] : '');
    $classe_niveau = trim(isset($_POST['classe_niveau']) ? $_POST['classe_niveau'] : '');

    if (empty($nom_matiere)) $erreurs[] = "Le nom de la matière est obligatoire";
    if (empty($classe_niveau)) $erreurs[] = "La classe/niveau est obligatoire";

    if (empty($erreurs)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO matieres (nom_matiere, classe_niveau) VALUES (?, ?)");
            $stmt->execute([$nom_matiere, $classe_niveau]);
            $message_confirmation = "Matière ajoutée avec succès !";
        } catch(PDOException $e) {
            $erreurs[] = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}

// Récupération des matières
$matieres = [];
try {
    $stmt = $pdo->query("SELECT * FROM matieres ORDER BY date_ajout DESC");
    $matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $erreurs[] = "Erreur lors de la récupération des matières";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseignement - Professeur Mme Sogoba Jacqueline Konate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="about.html">À propos</a></li>
            <li><a href="enseignant.php" class="active">Enseignement</a></li>
            <li><a href="emploi.php">Emploi du temps</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="teaching-container">
        <h1>Informations Pédagogiques</h1>

        <section class="add-subject">
            <h2>Ajouter une matière</h2>

            <?php if (!empty($message_confirmation)): ?>
                <div class="success-message"><?php echo $message_confirmation; ?></div>
            <?php endif; ?>

            <?php if (!empty($erreurs)): ?>
                <div class="error-messages">
                    <?php foreach($erreurs as $erreur): ?>
                        <p><?php echo $erreur; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="enseignant.php" class="subject-form">
                <div class="form-group">
                    <label for="nom_matiere">Nom de la matière</label>
                    <input type="text" id="nom_matiere" name="nom_matiere" required>
                </div>

                <div class="form-group">
                    <label for="classe_niveau">Classe/Niveau</label>
                    <select id="classe_niveau" name="classe_niveau" required>
                        <option value="">Sélectionner...</option>
                        <option value="6ème">6ème</option>
                        <option value="5ème">5ème</option>
                        <option value="4ème">4ème</option>
                        <option value="3ème">3ème</option>
                        <option value="2nde">2nde</option>
                        <option value="1ère">1ère</option>
                        <option value="Terminale">Terminale</option>
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                    </select>
                </div>

                <button type="submit" name="ajouter_matiere" class="btn-submit">Ajouter</button>
            </form>
        </section>

        <section class="subjects-list">
            <h2>Matières enseignées</h2>

            <?php if (empty($matieres)): ?>
                <p>Aucune matière enregistrée pour le moment.</p>
            <?php else: ?>
                <div class="subjects-grid">
                    <?php foreach($matieres as $matiere): ?>
                        <div class="subject-card">
                            <h3><?php echo htmlspecialchars($matiere['nom_matiere']); ?></h3>
                            <p><strong>Niveau :</strong> <?php echo htmlspecialchars($matiere['classe_niveau']); ?></p>
                            <p><small>Ajouté le : <?php echo date('d/m/Y', strtotime($matiere['date_ajout'])); ?></small></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="resources">
            <h2>Ressources et supports de cours</h2>
            <div class="resources-list">
                <div class="resource-item">
                    <h3>Mathématiques</h3>
                    <ul>
                        <li><a href="resources/cours_mathematiques.pdf" target="_blank">Cours d'Algèbre - Niveau Terminale (PDF)</a></li>
                        <li><a href="resources/exercices_maths.pdf" target="_blank">Exercices corrigés - Analyse (PDF)</a></li>
                    </ul>
                </div>

                <div class="resource-item">
                    <h3>Physique</h3>
                    <ul>
                        <li><a href="resources/cours_physique.pdf" target="_blank">Mécanique Classique - 1ère (PDF)</a></li>
                        <li><a href="resources/tp_physique.pdf" target="_blank">Travaux pratiques - Électricité (PDF)</a></li>
                    </ul>
                </div>

                <div class="resource-item">
                    <h3>Chimie</h3>
                    <ul>
                        <li><a href="resources/exercices_chimie.pdf" target="_blank">Exercices de Chimie Organique (PDF)</a></li>
                        <li><a href="resources/formules_chimie.pdf" target="_blank">Formulaire de Chimie Générale (PDF)</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include("footer.php"); ?>
</body>
</html>