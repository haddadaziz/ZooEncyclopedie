<?php
include 'connexion.php';

$habitat_choisi = "";
$nourriture_choisie = "";
if (isset($_GET['habitat'])) {
    $habitat_choisi = $_GET['habitat'];
}
if (isset($_GET['nourriture'])) {
    $nourriture_choisie = $_GET['nourriture'];
}
if ($habitat_choisi != "" && $nourriture_choisie != "") {
    $sql = "SELECT * FROM animal WHERE habitat_animal = '$habitat_choisi' AND regime_animal = '$nourriture_choisie'";
} elseif ($habitat_choisi != "") {
    $sql = "SELECT * FROM animal WHERE habitat_animal = '$habitat_choisi'";
} elseif ($nourriture_choisie != "") {
    $sql = "SELECT * FROM animal WHERE regime_animal = '$nourriture_choisie'";
} else {
    $sql = "SELECT * FROM animal";
}
$resultat = $conn->query($sql);

$sql_habitat = "SELECT * FROM habitat";
$resultat_habitat = $conn->query($sql_habitat);

$sql_carnivore = "SELECT * FROM animal WHERE regime_animal='Carnivore'";
$resultat_carnivore = $conn->query($sql_carnivore);

// Partie statistiques
$sql_carni = "SELECT * FROM animal WHERE regime_animal='Carnivore'";
$res_carni = $conn->query($sql_carni);
$nb_carni = $res_carni->num_rows;

$sql_herbi = "SELECT * FROM animal WHERE regime_animal='Herbivore'";
$res_herbi = $conn->query($sql_herbi);
$nb_herbi = $res_herbi->num_rows;


$sql_omni = "SELECT * FROM animal WHERE regime_animal='Omnivore'";
$res_omni = $conn->query($sql_omni);
$nb_omni = $res_omni->num_rows;

$total_zoo = $nb_carni + $nb_herbi + $nb_omni;

if ($total_zoo > 0) {
    $pct_carni = round(($nb_carni / $total_zoo) * 100);
    $pct_herbi = round(($nb_herbi / $total_zoo) * 100);
    $pct_omni = round(($nb_omni / $total_zoo) * 100);
} else {
    $pct_carni = 0;
    $pct_herbi = 0;
    $pct_omni = 0;
}

// Mode éducateur
$sql_educ = $sql;
$resultat_educ = $conn->query($sql_educ);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Encyclopédie</title>
    <link rel="shortcut icon" href="images/favicon_zoo.png" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" src="style.css">
</head>

<body class="bg-blue-50 text-gray-800 min-h-screen flex flex-col">
    <section id="homepage_view">
        <nav class="bg-white shadow-md sticky top-0 z-50 border-b-4 border-zoo-green">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-20 items-center">

                    <div class="flex items-center gap-3 hover:scale-105 transition">
                        <span class="text-4xl">📚</span>
                        <h1 class="text-3xl font-bold text-green-600 tracking-wide">ZooEncyclopédie</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        <button id="go_to_statistiques_button"
                            class="bg-orange-100 text-orange-600 px-5 py-2 rounded-full font-bold hover:bg-orange-200 transition shadow-sm flex items-center gap-2">
                            <span>📊</span>
                            <span class="hidden md:inline">Statistiques</span>
                        </button>

                        <button id="mode_educateur_button"
                            class="bg-purple-100 text-purple-600 px-5 py-2 rounded-full font-bold hover:bg-purple-200 transition shadow-sm flex items-center gap-2">
                            <span>🔒</span>
                            <span class="hidden md:inline">Éducateur</span>
                        </button>
                    </div>

                </div>
            </div>
        </nav>

        <div class="bg-white py-8 shadow-sm">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-2xl font-bold text-blue-600 mb-6">Que veux-tu découvrir aujourd'hui ?</h2>

                <form action="" method="GET"
                    class="flex flex-col md:flex-row justify-center items-center gap-4 bg-blue-50 p-6 rounded-3xl border-2 border-blue-100">

                    <div class="w-full md:w-1/3">
                        <label class="block text-left text-blue-800 font-bold mb-1 ml-2">Habitat</label>
                        <select name="habitat"
                            class="w-full bg-white border-2 border-blue-200 text-gray-700 py-3 px-4 pr-8 rounded-xl focus:outline-none focus:border-blue-500 font-bold cursor-pointer hover:border-blue-300 transition">
                            <option value="">🌍 Tous les habitats</option>
                            <option value="1" <?php if ($habitat_choisi == "1") {
                                echo "selected";
                            } ?>>Savane</option>
                            <option value="2" <?php if ($habitat_choisi == "2") {
                                echo "selected";
                            } ?>>Jungle</option>
                            <option value="3" <?php if ($habitat_choisi == "3") {
                                echo "selected";
                            } ?>>Océan</option>
                            <option value="4" <?php if ($habitat_choisi == "4") {
                                echo "selected";
                            } ?>>Désert</option>
                        </select>
                    </div>

                    <div class="w-full md:w-1/3">
                        <label class="block text-left text-green-800 font-bold mb-1 ml-2">Régime Alimentaire
                        </label>
                        <select name="nourriture"
                            class="w-full bg-white border-2 border-green-200 text-gray-700 py-3 px-4 pr-8 rounded-xl focus:outline-none focus:border-green-500 font-bold cursor-pointer hover:border-green-300 transition">
                            <option value="">🍏 Tout type alimentaire</option>
                            <option value="Carnivore" <?php if ($nourriture_choisie == "Carnivore") {
                                echo "selected";
                            } ?>>
                                🥩 Carnivore</option>
                            <option value="Herbivore" <?php if ($nourriture_choisie == "Herbivore") {
                                echo "selected";
                            } ?>>
                                🌿 Herbivore</option>
                            <option value="Omnivore" <?php if ($nourriture_choisie == "Omnivore") {
                                echo "selected";
                            } ?>>🍇
                                Omnivore</option>
                        </select>
                    </div>

                    <div class="w-full md:w-auto mt-6 md:mt-0 pt-1">
                        <button type="submit" onclick="localStorage.setItem('vueActuelle', 'educateur')"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition active:scale-95 flex items-center justify-center gap-2 mt-6">
                            <span>🔍</span> Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <main class="max-w-7xl mx-auto px-4 py-12 flex-grow">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php
                if ($resultat->num_rows > 0) {
                    while ($row = $resultat->fetch_assoc()) {
                        ?>

                        <div class="bg-white rounded shadow-lg">

                            <img src="<?php echo $row['image_animal']; ?>" alt="Image animal" class="w-full h-48 object-cover">

                            <div class="p-4">
                                <h2 class="text-xl font-bold mb-2">
                                    <?php echo $row['nom_animal']; ?>
                                </h2>

                                <p class="text-gray-600">
                                    <?php echo $row['regime_animal']; ?>
                                </p>
                            </div>

                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Aucun animal trouvé !</p>";
                }
                ?>
            </div>
        </main>

        <footer class="bg-white py-6 text-center border-t border-gray-200 mt-auto">
            <p class="text-gray-400 font-bold text-sm">Projet ZooEncyclopédie YouCode Haddad Aziz © 2025</p>
        </footer>
    </section>

    <section id="statistiques_view" class="hidden">
        <nav class="p-4">
            <button id="back_to_homepage_view"
                class="inline-flex items-center gap-2 text-orange-600 font-bold hover:underline">
                ⬅️ Retour au Zoo
            </button>
        </nav>

        <div class="max-w-4xl mx-auto px-4 py-8 text-center">
            <h1 class="text-4xl font-bold text-orange-500 mb-2">Les Chiffres du Zoo</h1>
            <p class="text-gray-500 mb-10">Découvre combien d'animaux vivent ici !</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

                <div class="bg-white p-6 rounded-3xl shadow-lg border-b-4 border-blue-400">
                    <div class="text-5xl mb-2">🦁</div>
                    <div class="text-4xl font-bold text-blue-500 mb-1"><?php echo $resultat->num_rows; ?></div>
                    <div class="text-gray-400 font-bold uppercase text-sm">Animaux</div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-lg border-b-4 border-green-400">
                    <div class="text-5xl mb-2">🌍</div>
                    <div class="text-4xl font-bold text-green-500 mb-1"><?php echo $resultat_habitat->num_rows; ?></div>
                    <div class="text-gray-400 font-bold uppercase text-sm">Habitats</div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-lg border-b-4 border-red-400">
                    <div class="text-5xl mb-2">🥩</div>
                    <div class="text-4xl font-bold text-red-500 mb-1"><?php echo $resultat_carnivore->num_rows; ?></div>
                    <div class="text-gray-400 font-bold uppercase text-sm">Mangeurs de viande</div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-xl text-left">
                <h2 class="text-2xl font-bold text-gray-700 mb-6">Répartition par Régime Alimentaire</h2>

                <div class="mb-6">
                    <div class="flex justify-between mb-1 font-bold text-gray-600">
                        <span>🥩 Carnivores : <?php echo $nb_carni; ?></span>
                        <span><?php echo $pct_carni; ?>%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-6">
                        <div class="bg-red-400 h-6 rounded-full" style="width: <?php echo $pct_carni; ?>%"></div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between mb-1 font-bold text-gray-600">
                        <span>🌿 Herbivores : <?php echo $nb_herbi; ?></span>
                        <span><?php echo $pct_herbi; ?>%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-6">
                        <div class="bg-green-400 h-6 rounded-full" style="width: <?php echo $pct_herbi; ?>%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-1 font-bold text-gray-600">
                        <span>🍇 Omnivores : <?php echo $nb_omni; ?></span>
                        <span><?php echo $pct_omni; ?>%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-6">
                        <div class="bg-yellow-400 h-6 rounded-full" style="width: <?php echo $pct_omni; ?>%"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="educateur_view" class="hidden min-h-screen bg-purple-50">

        <nav class="bg-white shadow-md sticky top-0 z-50 border-b-4 border-purple-600">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <span class="text-4xl">🔒</span>
                        <h1 class="text-3xl font-bold text-purple-700 tracking-wide">Mode Educateur</h1>
                    </div>

                    <button id="back_from_educateur"
                        class="bg-gray-200 text-gray-700 px-5 py-2 rounded-full font-bold hover:bg-gray-300 transition shadow-sm flex items-center gap-2">
                        <span>⬅️</span> Retour Visiteur
                    </button>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-4 py-12">

            <div
                class="mb-8 flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-purple-100">
                <div>
                    <h2 class="text-2xl font-bold text-purple-800">Gestion des Animaux</h2>
                    <p class="text-gray-500">Ajouter un animal.</p>
                </div>
                <a href="ajouter.php"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transform transition hover:scale-105 flex items-center gap-2">
                    <span>➕</span> Nouvel Animal
                </a>
            </div>
            <div
                class="mb-8 flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-purple-100">
                <div>
                    <h2 class="text-2xl font-bold text-purple-800">Gestion des Habitats</h2>
                    <p class="text-gray-500">Ajouter/Modifier un habitat.</p>
                </div>
                <a href="modifier_habitat.php"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transform transition hover:scale-105 flex items-center gap-2 ml-96">
                    <span>➕</span> Modifier Habitat
                </a>
                <a href="ajouter_habitat.php"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transform transition hover:scale-105 flex items-center gap-2">
                    <span>➕</span> Ajouter Habitat
                </a>
            </div>

            <div class="bg-white py-8 shadow-sm">
                <div class="max-w-4xl mx-auto px-4 text-center">
                    <h2 class="text-2xl font-bold text-blue-600 mb-6">Filtrer les animaux par : </h2>

                    <form action="" method="GET"
                        class="flex flex-col md:flex-row justify-center items-center gap-4 bg-blue-50 p-6 rounded-3xl border-2 border-blue-100">

                        <div class="w-full md:w-1/3">
                            <label class="block text-left text-blue-800 font-bold mb-1 ml-2">Habitat</label>
                            <select name="habitat"
                                class="w-full bg-white border-2 border-blue-200 text-gray-700 py-3 px-4 pr-8 rounded-xl focus:outline-none focus:border-blue-500 font-bold cursor-pointer hover:border-blue-300 transition">
                                <option value="">🌍 Tous les habitats</option>
                                <option value="1" <?php if ($habitat_choisi == "1") {
                                    echo "selected";
                                } ?>>Savane</option>
                                <option value="2" <?php if ($habitat_choisi == "2") {
                                    echo "selected";
                                } ?>>Jungle</option>
                                <option value="3" <?php if ($habitat_choisi == "3") {
                                    echo "selected";
                                } ?>>Océan</option>
                                <option value="4" <?php if ($habitat_choisi == "4") {
                                    echo "selected";
                                } ?>>Désert</option>
                            </select>
                        </div>

                        <div class="w-full md:w-1/3">
                            <label class="block text-left text-green-800 font-bold mb-1 ml-2">Régime Alimentaire
                            </label>
                            <select name="nourriture"
                                class="w-full bg-white border-2 border-green-200 text-gray-700 py-3 px-4 pr-8 rounded-xl focus:outline-none focus:border-green-500 font-bold cursor-pointer hover:border-green-300 transition">
                                <option value="">🍏 Tout type alimentaire</option>
                                <option value="Carnivore" <?php if ($nourriture_choisie == "Carnivore") {
                                    echo "selected";
                                } ?>>
                                    🥩 Carnivore</option>
                                <option value="Herbivore" <?php if ($nourriture_choisie == "Herbivore") {
                                    echo "selected";
                                } ?>>
                                    🌿 Herbivore</option>
                                <option value="Omnivore" <?php if ($nourriture_choisie == "Omnivore") {
                                    echo "selected";
                                } ?>>🍇
                                    Omnivore</option>
                            </select>
                        </div>

                        <div class="w-full md:w-auto mt-6 md:mt-0 pt-1">
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition active:scale-95 flex items-center justify-center gap-2 mt-6">
                                <span>🔍</span> Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php
                // ON UTILISE LA NOUVELLE VARIABLE $resultat_educ
                if ($resultat_educ && $resultat_educ->num_rows > 0) {
                    while ($row = $resultat_educ->fetch_assoc()) {
                        ?>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-transparent hover:border-purple-300 transition group">

                            <div class="relative">
                                <img src="<?php echo $row['image_animal']; ?>" alt="Animal"
                                    class="w-full h-48 object-cover opacity-90 group-hover:opacity-100 transition">
                                <div
                                    class="absolute top-2 right-2 bg-purple-600 text-white px-2 py-1 rounded text-xs font-bold shadow">
                                    #<?php echo $row['id_animal']; ?>
                                </div>
                            </div>

                            <div class="p-4">
                                <h2 class="text-xl font-bold text-gray-800 mb-1"><?php echo $row['nom_animal']; ?></h2>
                                <p class="text-gray-500 text-sm mb-4 italic"><?php echo $row['regime_animal']; ?></p>

                                <div class="flex gap-3 pt-4 border-t border-gray-100">
                                    <a href="modifier.php?id=<?php echo $row['id_animal']; ?>"
                                        class="flex-1 bg-yellow-100 text-yellow-700 py-2 rounded-lg font-bold text-center hover:bg-yellow-200 transition text-sm flex items-center justify-center gap-1">✏️
                                        Modifier</a>
                                    <a href="supprimer.php?id=<?php echo $row['id_animal']; ?>"
                                        onclick="return confirm('Supprimer ?');"
                                        class="flex-1 bg-red-100 text-red-700 py-2 rounded-lg font-bold text-center hover:bg-red-200 transition text-sm flex items-center justify-center gap-1">🗑️
                                        Supprimer</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='col-span-3 text-center text-gray-400'>Aucun animal trouvé.</p>";
                }
                ?>

            </div>
        </main>
    </section>
    <!-- Notifications d'erreur ou de succes -->
    <div class="notification success hidden fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-500 text-white px-10 py-4 rounded-full shadow-2xl border-4 border-white/30 text-lg font-bold text-center min-w-[350px] shadow-green-500/50"
        id="success_notification"></div>
    <div class="notification error hidden fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-red-500 text-white px-10 py-4 rounded-full shadow-2xl border-4 border-white/30 text-lg font-bold text-center min-w-[350px] shadow-green-500/50"
        id="error_notification"></div>
</body>

</html>