<?php
include 'connexion.php';


$id_a_supprimer = $_GET['id'];

$sql = "DELETE FROM animal WHERE id_animal = $id_a_supprimer";
$conn->query($sql);

// retour sur la page prinipale
header("Location: index.php?status=success_delete");
exit();
?>