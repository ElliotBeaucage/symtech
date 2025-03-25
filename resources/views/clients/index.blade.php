<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10 px-6 flex flex-col lg:flex-row lg:justify-center">

        <aside class="w-full max-w-xs p-6 bg-white rounded-lg shadow-lg mb-8 lg:mb-0 lg:mr-8 mx-auto">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un Client</h2>
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="client-name" class="block text-sm font-medium text-gray-700">Nom du Client</label>
                    <input type="text" id="client-name" name="name" required
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                        placeholder="Nom du client">
                </div>

                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-[#003E7E] focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    Ajouter
                </button>
            </form>
            <div class="mb-6 mt-6">
                <form method="GET" action="{{ route('clients.index') }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                        placeholder="Rechercher un client...">
                    <button type="submit" class="mt-2 px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#003E7E]">
                        Rechercher
                    </button>
                </form>
            </div>

        </aside>

        <div class="flex-1">
            <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Nos Clients</h1>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($clients as $client)
                    <div class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition relative h-40">

                        <a href="{{ route('buildings.index',['client' => $client->id]) }}">
                            <h2 class="text-xl font-bold text-gray-800 mb-2">{{$client->name}}</h2>
                        </a>



                        <div class="mt-4 flex justify-between ">

                            <a href="{{route('clients.edit', ['id' => $client->id])}}" class="text-[#003E7E] hover:text-[#003E7E] font-semibold">
                                Modifier
                            </a>

                            <form action="{{route('clients.destroy')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$client->id}}" name="id" id="id">
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
