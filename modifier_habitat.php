<?php
include 'connexion.php';
$nom = "";
$description = "";
$id_recupere_habitat_select = "";

$sql_tous_habitat = "SELECT * FROM habitat";
$resultat_tous_habitat = $conn->query($sql_tous_habitat);


if (isset($_GET['id'])) {
    $id_recupere_habitat_select = $_GET['id'];
    $sql_info = "SELECT * FROM habitat WHERE id_habitat = '$id_recupere_habitat_select'";
    $resultat_info = $conn->query($sql_info);
    // $nom = $_GET['nom_habitat'];
    // $description = $_GET['description_habitat'];
    if ($row = $resultat_info->fetch_assoc()) {
        $nom = $row['nom_habitat'];
        $description = $row['description_habitat'];
    }
}

if (isset($_POST['btn_update'])) {
    $id = $_POST['id_habitat'];
    $nom = $_POST['nom_habitat'];
    $description = $_POST['description_habitat'];
    $sql_update = "UPDATE habitat SET nom_habitat = '$nom',
                     description_habitat ='$description' WHERE id_habitat = '$id_recupere_habitat_select'";
    $conn->query($sql_update);
    header("Location: index.php?status=success_edit_habitat");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modifier Habitat</title>
</head>

<body class="bg-green-50 min-h-screen flex flex-col items-center pt-10">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg border-t-4 border-green-600">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Modifier un Habitat</h1>
            <a href="index.php" class="text-sm text-gray-500 hover:text-green-600 font-bold">⬅️ Accueil</a>
        </div>

        <form action="" method="GET" class="mb-8 border-b pb-6">
            <label class="block text-gray-500 text-xs font-bold uppercase mb-2">Choisis l'habitat à modifier :</label>
            <select name="id" onchange="this.form.submit()"
                class="w-full p-3 border-2 border-green-100 rounded-xl focus:border-green-500 font-bold cursor-pointer">
                <option value="">-- Sélectionner un habitat --</option>

                <?php
                if ($resultat_tous_habitat) {
                    $resultat_tous_habitat->data_seek(0);
                    while ($h = $resultat_tous_habitat->fetch_assoc()) {
                        $selected = "";
                        if ($h['id_habitat' == $id_recupere_habitat_select]) {
                            $selected = "selected";
                        }
                        echo "<option value='{$h['id_habitat']}' $selected>{$h['nom_habitat']}</option>";
                    }
                }
                ?>
            </select>
        </form>


        <?php if ($id_recupere_habitat_select != ""): ?>

            <form action="" method="POST" class="space-y-4">
                <input type="hidden" name="id_habitat" value="<?php echo $id_recupere_habitat_select; ?>">

                <div>
                    <label class="block text-gray-700 font-bold mb-1">Nouveau Nom</label>
                    <input type="text" name="nom_habitat" value="<?php echo $nom; ?>"
                        class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-1">Nouvelle Description</label>
                    <textarea name="description_habitat" rows="5"
                        class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 outline-none"
                        required><?php echo $description; ?></textarea>
                </div>

                <button type="submit" name="btn_update"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform active:scale-95">
                    💾 Enregistrer
                </button>
            </form>

        <?php else: ?>
            <p class="text-center text-gray-400 italic">👆 Sélectionne un habitat ci-dessus pour commencer.</p>
        <?php endif; ?>

    </div>

</body>

</html>