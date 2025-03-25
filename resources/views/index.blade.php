<x-layout>
    <main class="flex items-center justify-center min-h-screen bg-white  flex-col">
        <div class="w-full max-w-md p-8 border border-gray-300 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Connexion Employé</h2>

            <form action="{{ route("log-in") }}" method="POST">
                @csrf
                <!-- Nom de l'employé -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Prénom de l'employé</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-2 mt-2 bg-gray-100 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                           placeholder="Entrez votre nom">
                </div>

                <!-- Mot de passe -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 mt-2 bg-gray-100 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                           placeholder="Entrez votre mot de passe">
                </div>

                <!-- Bouton de soumission -->
                <input type="submit" value="Connexion" class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </input>

            </form>
        </div>
    </main>
</x-layout>
