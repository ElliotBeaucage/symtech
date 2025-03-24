<x-layout :user="null">

    <main class="min-h-screen bg-gray-100 flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Modifier le Batiment</h1>

            <form action="{{route('buildings.update')}}" method="POST">
                @csrf


                <div class="mb-4">
                    <label for="buildings-adresse" class="block text-sm font-medium text-gray-700">Adresse du batiments</label>
                    <input type="hidden" value="{{$building->id}}" name="id" id="id">
                    <input type="text" id="adresse" name="adresse" value="{{$building->adresse}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                           placeholder="Adresse du batiment">
                </div>


                <div class="flex justify-between items-center mt-6">
                    <a href="{{route('buildings.index',["client" => $building->client_id])}}" class="text-gray-600 hover:text-gray-800 font-semibold">Annuler</a>
                    <button type="submit" class="px-6 py-2 text-white bg-[#003E7E] rounded hover:bg-[#003E7E] focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </main>

</x-layout>
