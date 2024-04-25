<?php
// Inclure le fichier de connexion à la base de données
require_once 'conn.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $t = $_POST['T1'];
    $d = date("Y-m-d H:i:s");
    $c = $_POST['tx1'];
    
    // Vérifier si les champs sont vides
    if (!empty($t) && !empty($c)) {

        // Insérer le blog dans la base de données
        $sql = "INSERT INTO ajoutblog (titre, date, contenue) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$t, $d, $c]);

        header("location: index.php"); // Rediriger après l'ajout
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partager Votre Avis</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        header {
            background: #000;
            color: #fff;
            padding: 20px;
            text-align: center; /* Alignement du texte au centre */
        }

        header h1 {
            margin: 0; /* Supprimer les marges par défaut */
            font-family: "Times New Roman", serif; /* Change font family */
        }

        h2 {
            margin-bottom: 10px;
            font-family: "Times New Roman", serif;
            color: black;
        }

        h3 {
            font-family: "Times New Roman", serif;
            color: black;
        }
    </style>
</head>
<body background="2.jpg">
<header>
    <h1>Blog sur la Palestine</h1>
</header>

<div class="container">
    <div class="card p-3 mx-auto" style="max-width: 600px;">
        <h2 class="text-center">Partager Votre Avis</h2>
        <main>
            <form method="POST" >
                <div class="form-group">
                    <h3>Titre</h3>
                    <input type="text" class="form-control" name="T1">
                </div>
                <div class="form-group">
                    <h3>Écrire Un Blog</h3>
                    <textarea class="form-control" id="blogTextarea" rows="5" placeholder="Écrivez votre avis ici" name="tx1"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
            </form>
        </main>
    </div>
</div>

<!-- Inclure Bootstrap JS (optionnel, si nécessaire) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
