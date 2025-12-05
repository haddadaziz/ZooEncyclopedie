<?php
include 'connexion.php';
$nom = $conn->real_escape_string($_POST['nom_animal']);
$image = $conn->real_escape_string($_POST['image_animal']);
$regime = $conn->real_escape_string($_POST['regime_animal']);
$nom_habitat_entre = $conn->real_escape_string($_POST['nom_habitat']);
$description_habitat_entre = $conn->real_escape_string($_POST['description_habitat']);
$check_sql = "SELECT id_habitat FROM habitat WHERE nom_habitat = '$nom_habitat_entre'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    $row = $check_result->fetch_assoc();
    $id_habitat_final = $row['id_habitat'];

} else {
    $insert_habitat_sql = "INSERT INTO habitat (nom_habitat,description_habitat) VALUES ('$nom_habitat_entre','$description_habitat_entre')";
    $conn->query($insert_habitat_sql);
    $id_habitat_final = $conn->insert_id;
}
$insert_animal = "INSERT INTO animal (nom_animal, image_animal, regime_animal, habitat_animal) 
                  VALUES ('$nom', '$image', '$regime', '$id_habitat_final')";
$conn->query($insert_animal);
header("Location: index.php?status=success_ajouter_animal");
exit();
?>