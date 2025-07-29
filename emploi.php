<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du temps - Professeur Mme Sogoba Jacqueline Konate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="about.html">À propos</a></li>
            <li><a href="enseignant.php">Enseignement</a></li>
            <li><a href="emploi.php" class="active">Emploi du temps</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="schedule-container">
        <h1>Emploi du temps hebdomadaire</h1>

        <table class="schedule-table">
            <thead>
            <tr>
                <th>Horaires</th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="time-slot">08h00 - 09h00</td>
                <td class="class math">Mathématiques<br><small>Terminale S</small></td>
                <td class="class physics">Physique<br><small>1ère S</small></td>
                <td class="empty">-</td>
                <td class="class math">Mathématiques<br><small>2nde</small></td>
                <td class="class chemistry">Chimie<br><small>Terminale S</small></td>
            </tr>
            <tr>
                <td class="time-slot">09h00 - 10h00</td>
                <td class="class physics">Physique<br><small>Terminale S</small></td>
                <td class="class math">Mathématiques<br><small>1ère S</small></td>
                <td class="empty">-</td>
                <td class="class physics">Physique<br><small>2nde</small></td>
                <td class="class math">Mathématiques<br><small>Terminale S</small></td>
            </tr>
            <tr class="break">
                <td class="time-slot">10h00 - 10h15</td>
                <td colspan="5" class="break-time">PAUSE</td>
            </tr>
            <tr>
                <td class="time-slot">10h15 - 11h15</td>
                <td class="class chemistry">Chimie<br><small>1ère S</small></td>
                <td class="class physics">TP Physique<br><small>Terminale S</small></td>
                <td class="empty">-</td>
                <td class="class math">Mathématiques<br><small>1ère S</small></td>
                <td class="class physics">Physique<br><small>2nde</small></td>
            </tr>
            <tr>
                <td class="time-slot">11h15 - 12h15</td>
                <td class="class math">Mathématiques<br><small>2nde</small></td>
                <td class="class chemistry">Chimie<br><small>2nde</small></td>
                <td class="empty">-</td>
                <td class="class physics">Physique<br><small>Terminale S</small></td>
                <td class="office-hours">Permanence</td>
            </tr>
            <tr class="lunch">
                <td class="time-slot">12h15 - 14h00</td>
                <td colspan="5" class="lunch-time">PAUSE DÉJEUNER</td>
            </tr>
            <tr>
                <td class="time-slot">14h00 - 15h00</td>
                <td class="class physics">TP Physique<br><small>1ère S</small></td>
                <td class="class math">Soutien Math<br><small>Terminale</small></td>
                <td class="class chemistry">Chimie<br><small>1ère S</small></td>
                <td class="empty">-</td>
                <td class="empty">-</td>
            </tr>
            <tr>
                <td class="time-slot">15h00 - 16h00</td>
                <td class="class chemistry">TP Chimie<br><small>Terminale S</small></td>
                <td class="office-hours">Permanence</td>
                <td class="class physics">Physique<br><small>2nde</small></td>
                <td class="empty">-</td>
                <td class="empty">-</td>
            </tr>
            <tr>
                <td class="time-slot">16h00 - 17h00</td>
                <td class="office-hours">Préparation cours</td>
                <td class="office-hours">Correction copies</td>
                <td class="office-hours">Réunion équipe</td>
                <td class="empty">-</td>
                <td class="empty">-</td>
            </tr>
            </tbody>
        </table>

        <div class="legend">
            <h3>Légende</h3>
            <div class="legend-items">
                <div class="legend-item">
                    <span class="legend-color math"></span>
                    <span>Mathématiques</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color physics"></span>
                    <span>Physique</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color chemistry"></span>
                    <span>Chimie</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color office-hours"></span>
                    <span>Permanence/Administration</span>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
</body>
</html>