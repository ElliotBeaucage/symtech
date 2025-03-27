<x-layout :user="null">

    <main class="min-h-screen bg-gray-100 flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Modifier la machine</h1>

            <form action="{{route('machines.update')}}" method="POST">
                @csrf


                <div class="mb-4">
                    <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Type/genre</label>
                    <input type="hidden" value="{{$machine->id}}" name="id" id="id">
                    <input type="text" id="type" name="type" value="{{$machine->type}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="type/genre">
                           <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Marque</label>
                    <input type="text" id="marque" name="marque" value="{{$machine->marque}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Marque">
                           <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Modèle</label>
                    <input type="text" id="modele" name="modele" value="{{$machine->modele}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Modèle">
                           <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Série</label>
                    <input type="text" id="serie" name="serie" value="{{$machine->serie}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Série">
                           <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Courroie</label>
                    <input type="text" id="courroie" name="courroie" value="{{$machine->courroie}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Courroie">
                           <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Filtre</label>
                    <input type="text" id="filtres" name="filtres" value="{{$machine->filtres}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Filtre">
                           <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Freon(Gaz)</label>
                    <input type="text" id="freon" name="freon" value="{{$machine->freon}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Freon">
                </div>


                <div class="flex justify-between items-center mt-6">
                    <a href="{{route('machines.index',["buildings" => $machine->building_id])}}" class="text-gray-600 hover:text-gray-800 font-semibold">Annuler</a>
                    <button type="submit" class="px-6 py-2 text-white bg-[#003E7E] rounded hover:bg-[#003E7E] focus:outline-none focus:ring-2 ">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </main>

</x-layout>
