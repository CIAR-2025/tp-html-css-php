<?php
require_once 'config.php';

$message_confirmation = "";
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validation des champs
    $prenoms = trim(isset($_POST['prenoms']) ? $_POST['prenoms'] : '');
    $nom = trim(isset($_POST['nom']) ? $_POST['nom'] : '');
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
    $telephone = trim(isset($_POST['telephone']) ? $_POST['telephone'] : '');
    $objet = trim(isset($_POST['objet']) ? $_POST['objet'] : '');
    $message = trim(isset($_POST['message']) ? $_POST['message'] : '');

    // Vérifications
    if (empty($prenoms)) $erreurs[] = "Les prénoms sont obligatoires";
    if (empty($email)) $erreurs[] = "L'email est obligatoire";
    if (empty($objet)) $erreurs[] = "L'objet est obligatoire";
    if (empty($message)) $erreurs[] = "Le message est obligatoire";

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "Format d'email invalide";
    }

    if (!empty($telephone)) {
        if (!preg_match('/^[0-9+\-\s()]+$/', $telephone)) {
            $erreurs[] = "Le téléphone ne doit contenir que des chiffres";
        }
        if (strlen(preg_replace('/[^0-9]/', '', $telephone)) > 12) {
            $erreurs[] = "Le téléphone ne doit pas excéder 12 chiffres";
        }
    }

    // Enregistrement si pas d'erreurs
    if (empty($erreurs)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (prenoms, nom, email, telephone, objet, message) 
                                   VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$prenoms, $nom, $email, $telephone, $objet, $message]);
            $message_confirmation = "Votre message a été envoyé avec succès !";

            // Réinitialiser les variables
            $prenoms = $nom = $email = $telephone = $objet = $message = "";
        } catch(PDOException $e) {
            $erreurs[] = "Erreur lors de l'envoi : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Professeur Mme Sogoba Jacqueline Konate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="about.html">À propos</a></li>
            <li><a href="enseignant.php">Enseignement</a></li>
            <li><a href="emploi.php">Emploi du temps</a></li>
            <li><a href="contact.php" class="active">Contact</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="contact-container">
        <h1>Contactez-moi</h1>

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

        <form method="POST" action="contact.php" class="contact-form">
            <div class="form-group">
                <label for="prenoms">Prénoms *</label>
                <input type="text" id="prenoms" name="prenoms" required
                       value="<?php echo htmlspecialchars(isset($prenoms) ? $prenoms : ''); ?>">
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom"
                       value="<?php echo htmlspecialchars(isset($nom) ? $nom : ''); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email institutionnel *</label>
                <input type="email" id="email" name="email" required
                       value="<?php echo htmlspecialchars(isset($email) ? $email : ''); ?>">
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" maxlength="12"
                       pattern="[0-9+\-\s()]+"
                       value="<?php echo htmlspecialchars(isset($telephone) ? $telephone : ''); ?>">
            </div>

            <div class="form-group">
                <label for="objet">Objet *</label>
                <input type="text" id="objet" name="objet" required
                       value="<?php echo htmlspecialchars(isset($objet) ? $objet : ''); ?>">
            </div>

            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" rows="5" required><?php echo htmlspecialchars(isset($message) ? $message : ''); ?></textarea>
            </div>

            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </div>
</main>

<?php include("footer.php"); ?>
</body>
</html>