<?php
include 'conn.php';

class Admin {
    private $id;
    private $username;
    private $password;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // bch na3mlou hydratation lel objet admin avec un tableau
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // CRUD 

    // Cbch nasn3ou user jdid
    public function create(PDO $pdo) {
        $stmt = $pdo->prepare("INSERT INTO user (nom,mail,password) VALUES (?,?,?)");
        
        return $stmt->execute();
    }

    // bch nlawjou ala user
    public static function getById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $admin = new Admin();
        $admin->hydrate($data);
        return $admin;
    }

    // bch na"mlou update l user 
    public function update(PDO $pdo) {
        $stmt = $pdo->prepare("UPDATE user SET id = :id, password = :password WHERE nom = :username");
        $stmt->bindParam(':username', $this->nom);
        $stmt->bindParam(':email', $this->mail);
        $stmt->bindParam(':password', $this->password);
        return $stmt->execute();
    }

    // bch nfasskhou user
    public function delete(PDO $pdo) {
        $stmt = $pdo->prepare("DELETE FROM user WHERE nom = :username");
        $stmt->bindParam(':username', $this->nom);
        return $stmt->execute();
    }
        // bch nfasskhou blog 
        public function delete2(PDO $pdo) {
            $stmt = $pdo->prepare("DELETE FROM ajoutblog WHERE titre = :titre");
            $stmt->bindParam(':titre', $this->titre);
            return $stmt->execute();
        }
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogeur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('2.jpg');
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-box {
            max-width: 500px;
            max-height: 80vh; /* Hauteur maximale */
            overflow-y: auto; /* Activation du défilement vertical si nécessaire */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
        }

        .btn-primary, .btn-danger, .btn-warning {
            width: 100%;
        }

        .titre {
            text-align: center;
            margin-bottom: 30px;
        }

        @media (max-width: 576px) {
            .login-box {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="login-box">
    <h1 class="titre">CRUD ADMIN</h1>

    <h2 class="add">Add new user</h2>
    <form action="create.php" method="post" id="f1">
        <div class="form-group">
            <label for="username">name</label>
            <input type="text" id="username" name="T1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="new_username">Email</label>
            <input type="text" id="new_username" name="T2" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">password</label>
            <input type="password" id="password" name="T3" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <br>

    <h2 class="update">Update user</h2>
    <form action="update.php" method="post" id="f2">
        <div class="form-group">
            <label for="update_id">name</label>
            <input type="text" id="update_id" name="T1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="new_username">E-mail</label>
            <input type="text" id="new_username" name="T2" class="form-control">
        </div>
        <div class="form-group">
            <label for="new_password">Password</label>
            <input type="password" id="new_password" name="T3" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Mise à jour</button>
    </form>

    <h2 class="delete">Deleate user</h2>
    <form action="delete.php" method="post" id="f3">
        <div class="form-group">
            <label for="delete_id">name</label>
            <input type="text" id="delete_id" name="T1" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <h2 class="select">Delete  Blog </h2>
    <form action="supp2.php" method="post" id="f4">
        <div class="form-group">
            <label for="admin_id">Titre</label>
            <input type="text" id="admin_id" name="T1" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning">Supprimer</button>
    </form>
    <br>
</div>

<script src="vendor\twbs\bootstrap\dist\js/bootstrap.min.js"></script>
</body>
</html>
