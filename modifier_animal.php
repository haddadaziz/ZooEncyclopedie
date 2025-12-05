<?php
include 'connexion.php';

$nom = "";
$regime = "";
$habitat_actuel = "";
$image = "";
$id_recupere = "";

if (isset($_GET['id'])) {
    $id_recupere = $_GET['id'];
    $sql_modifier_animal = "SELECT * FROM animal WHERE id_animal = '$id_recupere'";
    $resultat = $conn->query($sql_modifier_animal);

    if ($row = $resultat->fetch_assoc()) {
        $nom = $row['nom_animal'];
        $regime = $row['regime_animal'];
        $habitat_actuel = $row['habitat_animal'];
        $image = $row['image_animal'];
    }
}

if (isset($_POST['btn_update'])) {
    $id = $_POST['id_animal'];
    $nom = $_POST['nom_animal'];
    $regime = $_POST['regime_animal'];
    $habitat = $_POST['habitat_animal'];
    $image = $_POST['image_animal'];
    $sql_update = "UPDATE animal SET 
                   nom_animal = '$nom', 
                   regime_animal = '$regime', 
                   habitat_animal = '$habitat', 
                   image_animal = '$image' 
                   WHERE id_animal = '$id'";

    $conn->query($sql_update);
    header("Location: index.php?status=success_edit_animal");
    exit();
}
$liste_habitats = $conn->query("SELECT * FROM habitat");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js defer"></script>
    <title>Modifier Animal</title>
</head>
<body class="bg-purple-50 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg border-t-4 border-purple-600">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Modifier l'animal #<?php echo $id_recupere; ?></h1>
            <a href="index.php" class="text-sm text-gray-500 hover:text-purple-600 font-bold">⬅️ Annuler</a>
        </div>

        <form action="" method="POST" class="space-y-4">
            
            <input type="hidden" name="id_animal" value="<?php echo $id_recupere; ?>">

            <div>
                <label class="block text-gray-700 font-bold mb-1">Nom de l'animal</label>
                <input type="text" name="nom_animal" value="<?php echo $nom; ?>" 
                       class="w-full p-3 border-2 border-purple-100 rounded-xl focus:border-purple-500 outline-none" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-1">Régime Alimentaire</label>
                <select name="regime_animal" class="w-full p-3 border-2 border-purple-100 rounded-xl focus:border-purple-500 outline-none">
                    <option value="Carnivore" <?php if($regime == "Carnivore") echo "selected"; ?>>🥩 Carnivore</option>
                    <option value="Herbivore" <?php if($regime == "Herbivore") echo "selected"; ?>>🌿 Herbivore</option>
                    <option value="Omnivore" <?php if($regime == "Omnivore") echo "selected"; ?>>🍇 Omnivore</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-1">Habitat</label>
                <select name="habitat_animal" class="w-full p-3 border-2 border-purple-100 rounded-xl focus:border-purple-500 outline-none">
                    
                    <?php
                        while ($h = $liste_habitats->fetch_assoc()) {
                            $selection = ""; 
                            if ($h['id_habitat'] == $habitat_actuel) {
                                $selection = "selected";
                            }
                            
                            echo "<option value='{$h['id_habitat']}' $selection>{$h['nom_habitat']}</option>";
                        }
                    ?>

                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-1">URL de l'image</label>
                <input type="text" name="image_animal" value="<?php echo $image; ?>" 
                       class="w-full p-3 border-2 border-purple-100 rounded-xl focus:border-purple-500 outline-none">
            </div>

            <button type="submit" name="btn_update" 
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform active:scale-95">
                💾 Sauvegarder
            </button>
        </form>
    </div>

</body>
</html>