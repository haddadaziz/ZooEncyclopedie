<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-10">

    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-purple-600">Ajouter un Animal</h1>
        
        <form action="traitement_ajout_animal.php" method="POST" class="space-y-4">
            
            <div>
                <label class="block font-bold mb-1">Nom de l'animal</label>
                <input type="text" name="nom_animal" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block font-bold mb-1">URL de l'image</label>
                <input type="text" name="image_animal" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block font-bold mb-1">Régime</label>
                <select name="regime_animal" class="w-full border p-2 rounded">
                    <option value="Carnivore">Carnivore</option>
                    <option value="Herbivore">Herbivore</option>
                    <option value="Omnivore">Omnivore</option>
                </select>
            </div>

            <div>
                <label class="block font-bold mb-1 text-green-600">Habitat</label>
                <input type="text" name="nom_habitat" class="w-full border-2 border-green-200 p-2 rounded" placeholder="Ex: Savane" required>
            </div>
            <div>
                <label class="block font-bold mb-1 text-green-600">Description Habitat (Optionnel)</label>
                <textarea type="text" name="description_habitat" class="w-full border-2 border-green-200 p-2 rounded" placeholder="Entrez une description ..."></textarea>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white font-bold py-3 rounded hover:bg-green-600">
                Enregistrer
            </button>
        </form>
        
        <a href="index.php" class="block text-center mt-4 text-gray-500">Retour</a>
    </div>

</body>
</html>