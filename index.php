<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog sur la Palestine</title>
    <link rel="stylesheet" href="vendor\twbs\bootstrap\dist\css/bootstrap.min.css">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('2.jpg');

            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background:black;
            color: #fff;
            padding: 20px;
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            text-align:center;

        }

        header h1 {
            margin-bottom: 10px;
            font-family: "Times New Roman", serif; 
        }

        nav ul {
            list-style: none;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-family: "Times New Roman", serif; 
        }

        main {
            padding: 20px;
        }

        .articles {
            display: flex;
            flex-direction: column;
            align-items: center; 
        }

        article {
            background-color: #fff;
            padding: 80px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; 
            max-width: 600px; 
        }

        article h2 {
            margin-bottom: 10px;
        }
        img {
            max-width: 100%; 
            height: auto; 
        }

        .meta {
            color: #888;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
        }

        .btn:hover {
            background-color: #555;
        }

        .logo {
            position: absolute; 
            top: 100px; 
            left: 0px;
            width: 200px; 
            height: auto;  
            z-index: 1000; 
        }

        .article-textarea {
            width: 100%;
            height: auto; 
            min-height: 100px; 
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            resize: none;
        }

        footer{
            background:#135D66;
            color: #fff;
        }
    
    .image-container {
        max-width: 100%;
        overflow: hidden;
    }

    .article-image {
        max-width: 100%;
        height: auto;
    }
    .chatroom-image{position: absolute; 
            top: 100px;
            right: 0px; 
            width: 200px; 
            height: auto; 
            z-index: 1000;}
</style>
    </style>
</head>
<body>
<header>

    <h1>Blog sur la Palestine</h1>
</header>

<main>
<section class="articles">
<?php
require_once 'conn.php';

// Récupérer les données de la base de données avec les photos
try {
    $stmt = $conn->query("SELECT * FROM ajoutblog ;");
    $donnees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les données dans des articles avec leurs photos
    foreach ($donnees as $row) {
        echo '<article>';
        echo '<h2>' . $row['titre'] . '</h2>';
        echo '<p class="meta">' . $row['date'] . '</p>';
        echo '<p class="meta">' . $row['contenue'] . '</p>';

        echo '</article>';
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

        </section>
</main>



<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
