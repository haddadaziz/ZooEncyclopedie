<?php
include 'connexion.php';

$nom = $conn->real_escape_string($_POST['nom_habitat']);
$description = $conn->real_escape_string($_POST['description_habitat']);

$check_habitat_sql = "SELECT id_habitat FROM habitat WHERE nom_habitat = '$nom'";
$result = $conn->query($check_habitat_sql);

if ($result->num_rows > 0) {
    // si cet habitat existe deja
    header("Location: index.php?status=error_habitat_exists");
    exit();
} else {
    $insert_sql = "INSERT INTO habitat (nom_habitat, description_habitat) VALUES ('$nom', '$description')";
    $conn->query($insert_sql);
    header("Location: index.php?status=success_habitat");
    exit();
}
?>