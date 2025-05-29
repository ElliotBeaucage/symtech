<x-layout :user="auth()->user()">
    @if (session('success'))
    <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-200 shadow text-sm">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 border border-red-200 shadow text-sm">
        {{ session('error') }}
    </div>
@endif
    <main class="py-10">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:space-x-8">

                {{-- FORMULAIRE ET RECHERCHE --}}
                <aside class="w-full lg:max-w-sm bg-white p-6 rounded-lg shadow mb-8 lg:mb-0">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ajouter un Client</h2>

                    <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="client-name" class="block text-sm font-medium text-gray-700">Nom du Client</label>
                            <input type="text" id="client-name" name="name" required
                                   placeholder="Nom du client"
                                   class="w-full mt-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                        </div>
                        <button type="submit"
                                class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-[#002e5f] transition">
                            Ajouter
                        </button>
                    </form>

                    <div class="mt-8">
                        <form method="GET" action="{{ route('clients.index') }}" class="space-y-3">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Rechercher un client..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                            <button type="submit"
                                    class="w-full px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002e5f] transition">
                                Rechercher
                            </button>
                        </form>
                    </div>
                </aside>

                {{-- LISTE DES CLIENTS --}}
                <section class="flex-1">
                    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Nos Clients</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($clients as $client)
                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition h-40 flex flex-col justify-between">
                                <a href="{{ route('buildings.index',['client' => $client->id]) }}">
                                    <h2 class="text-xl font-bold text-gray-800">{{$client->name}}</h2>
                                </a>

                                <div class="flex justify-between items-center pt-4">
                                    <a href="{{ route('clients.edit', ['id' => $client->id]) }}"
                                       class="text-[#003E7E] hover:underline font-medium">Modifier</a>

                                    <form action="{{ route('clients.destroy') }}" method="POST" onsubmit="return confirm('Supprimer cet entretien ?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $client->id }}">
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layout>
