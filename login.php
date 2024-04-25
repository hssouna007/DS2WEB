<?php

include 'conn.php';

function searchuser($username, $password, $conn) {
  $sql = "SELECT * FROM user WHERE nom=? AND password=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username, $password]); // Utilisation d'un tableau pour les valeurs
  $user = $stmt->fetch();
  return $user; // Retourne l'utilisateur trouvé ou null s'il n'existe pas
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['T1'];
    $password = $_POST['T2'];
   
    $user = searchuser($username, $password, $conn);
   
    if ($user) {
        echo "Utilisateur existe";
        // Rediriger vers une page appropriée après la connexion réussie
        header("Location: index.php");
        exit(); // Assure que le script s'arrête après la redirection
    } else {
        echo "L'utilisateur n'existe pas";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            background-image: url('palestine.jpg');
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .login-box {
            width: 300px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
        }
        .login-box h2 {
            margin: 0 0 20px;
            padding: 0;
            color: #fff;
        }
        .login-box .form-control {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            color: #fff;
            padding: 10px;
            margin-bottom: 30px;
            box-sizing: border-box;
        }
        .login-box .form-control:focus {
            border-color: #ffc107;
        }
        .login-box input[type="submit"] {
            background: #ffc107;
            border: none;
            outline: none;
            color: #000;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .login-box input[type="submit"]:hover {
            background: #ffdb58;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form id="loginForm" method="post" action="" novalidate>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="T1" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="T2" placeholder="Password" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Login">
            </form>
        </div>
    </div>
</body>
</html>