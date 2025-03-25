<x-layout :user="auth()->user()">

    <main class="min-h-screen bg-gray-100 py-10 px-6 flex flex-col lg:flex-row lg:justify-center">
        <!-- Sidebar Formulaire d'ajout de client -->
        <aside class="w-full max-w-xs p-6 bg-white rounded-lg shadow-lg mb-8 lg:mb-0 lg:mr-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un batiment</h2>
            <form action="{{ route('buildings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="client_id" id="client_id" value="{{ $client->id }}">
                <!-- Nom du client -->
                <div class="mb-4">
                    <label for="client-name" class="block text-sm font-medium text-gray-700">Nom du batiment
                        (adresse)</label>
                    <input type="text" id="building-name" name="name" required
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                        placeholder="Nom du batiment">
                </div>
                <!-- Bouton de soumission -->
                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-[#003E7E] focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    Ajouter
                </button>
            </form>
            <div class="mb-6 mt-6">
                <form method="GET" action="{{ route('buildings.index', ['client' => $client->id]) }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                        placeholder="Rechercher un client...">
                    <button type="submit" class="mt-2 px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#003E7E]">
                        Rechercher

                    </button>
                </form>
                <a href="{{ route('clients.index', ['id' => $client->id]) }}"
                    class=" px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#003E7E]"
                    style="position: relative; top: 30px;">retour</a>

        </aside>

        <!-- Section de la liste de clients -->
        <div class="flex-1">
            <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center"></h1>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($buildings as $building)
                    <div class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition relative h-40">

                        <a href="{{ route('machines.index', ['buildings' => $building->id]) }}">
                            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $building->adresse }}</h2>
                        </a>

                        <div class="mt-4 flex justify-between ">

                            <a href="{{ route('buildings.edit', ['id' => $building->id]) }}"
                                class="text-[#003E7E] hover:text-[#003E7E] font-semibold">
                                Modifier
                            </a>

                            <form action="{{ route('buildings.destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $building->id }}" name="id" id="id">
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
    </main>





</x-layout>
