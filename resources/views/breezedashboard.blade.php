<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Benvenuto in AREA RISERVATA,') }} {{ Auth::user()->nome }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">👤 Dati del profilo</h3>

                    <ul class="divide-y divide-gray-200 text-sm">
                        <li class="flex items-center py-4">
                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="font-medium text-gray-700 w-48">Nome</span>
                            <span class="text-gray-900">{{ Auth::user()->nome }} {{ Auth::user()->cognome }}</span>
                        </li>

                        <li class="flex items-center py-4 bg-gray-50">
                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16 12H8m8 0H8m8 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span class="font-medium text-gray-700 w-48">Email</span>
                            <span class="text-gray-900">{{ Auth::user()->email }}</span>
                        </li>

                        <li class="flex items-center py-4">
                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 5h2l3.6 7.59-1.35 2.45A1 1 0 008 17h12m-1-5a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                            <span class="font-medium text-gray-700 w-48">Telefono</span>
                            <span class="text-gray-900">{{ Auth::user()->telefono ?? 'Non disponibile' }}</span>
                        </li>

                        <li class="flex items-center py-4 bg-gray-50">
                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium text-gray-700 w-48">Data di nascita</span>
                            <span class="text-gray-900">{{ Auth::user()->data_nascita ?? 'Non disponibile' }}</span>
                        </li>

                        <li class="flex items-center py-4">
                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 11h14M5 15h14M5 7h14"/>
                            </svg>
                            <span class="font-medium text-gray-700 w-48">Codice fiscale</span>
                            <span class="text-gray-900">{{ Auth::user()->codice_fiscale ?? 'Non disponibile' }}</span>
                        </li>

                        <li class="flex items-center py-4 bg-gray-50">
                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.657 16.657L13.414 12l4.243-4.243m-9.9 0L10.586 12l-4.243 4.243"/>
                            </svg>
                            <span class="font-medium text-gray-700 w-48">Indirizzo</span>
                            <span class="text-gray-900">{{ Auth::user()->indirizzo ?? 'Non disponibile' }}</span>
                        </li>
                    </ul>

                    <div class="mt-6 text-right">
                        <a href="{{ route('profile.edit') }}"
                            style="background-color: #38bdf8; color: white; padding: 10px 20px; border-radius: 8px;">
                            ✏️ <span class="ml-2">Modifica profilo</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
