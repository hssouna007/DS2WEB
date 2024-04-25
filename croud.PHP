<?php
include 'conn.php';

// bch nchoufou el method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['T1']; 

    // bch nchoufou el admin mawjoud wallé 
    $sql = "SELECT * FROM admin WHERE id=:id";
    
    // bch na3mlou requet preparé
    $stmt = $conn->prepare($sql);

    // norbtou el parametre b requet
    $stmt->bindParam(':id', $id);

    // exuction mta3 requet
    if ($stmt->execute()) {
        // Check if admin with provided ID exists
        if ($stmt->rowCount() > 0) {
          header("location: admin.php");

        } else {
            echo "Admin not found";
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $stmt->errorInfo()[2];
    }
}
?>
