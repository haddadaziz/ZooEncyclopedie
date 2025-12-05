<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-10">

    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border-t-4 border-green-500">
        <h1 class="text-2xl font-bold mb-6 text-center text-green-600">Ajouter un Habitat</h1>
        
        <form action="traitement_ajout_habitat.php" method="POST" class="space-y-4">
            
            <div>
                <label class="block font-bold mb-1 text-gray-700">Nom de l'habitat</label>
                <input type="text" name="nom_habitat" 
                       class="w-full border-2 border-green-200 p-2 rounded focus:outline-none focus:border-green-500 transition" 
                       placeholder="Ex: Jungle" required>
            </div>

            <div>
                <label class="block font-bold mb-1 text-gray-700">Description</label>
                <textarea name="description_habitat" rows="4"
                          class="w-full border-2 border-green-200 p-2 rounded focus:outline-none focus:border-green-500 transition" 
                          placeholder="Décris l'environnement ici..." required></textarea>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white font-bold py-3 rounded hover:bg-green-600 transition transform active:scale-95">
                Enregistrer l'habitat
            </button>
        </form>
        
        <a href="index.php" onclick="localStorage.setItem('vueActuelle', 'educateur')" 
           class="block text-center mt-6 text-gray-500 hover:text-green-600 hover:underline">
            Retour au menu
        </a>
    </div>

</body>
</html>