<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marcas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h1 class="pb-4">Modificación de una marca</h1>
    <!-- formulario -->
                    <div class="shadow-md rounded-md max-w-3xl mb-72">
                        <form action="/marca/update" method="post">
                        @method('put')
                        @csrf
                            <div class="p-6 bg-white">
                                <label for="mkNombre" class="block text-sm font-medium text-gray-500">
                                    Nombre de la marca
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="mkNombre"
                                           value="{{ $Marca->mkNombre }}"
                                           id="mkNombre" class="p-2  text-yellow-700 text-2xl focus:ring-yellow-300 focus:border-yellow-300 flex-1 block w-full rounded-none rounded-r-md border-gray-300">
                                </div>
                                    <input type="hidden" name="idMarca"
                                           value="{{ $Marca->idMarca }}">

                                <div class="py-6 flex items-center justify-end">

                                    <button class="text-yellow-900 hover:text-yellow-800
                                        bg-yellow-400 hover:bg-yellow-300 px-5 py-1 mr-6
                                        border border-yellow-500 rounded
                                        ">Agregar marca</button>
                                    <a href="/marcas" class="text-yellow-600 hover:text-yellow-500
                                        bg-gray-50 hover:bg-white px-5 py-1
                                        border border-gray-300 rounded
                                        ">Volver a panel de marcas</a>

                                </div>

                            </div>
                        </form>
                    </div>
        <!-- FIN formulario -->


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
