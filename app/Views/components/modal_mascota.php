<!-- Modal toggle -->
<div class="flex justify-center mt-4">
    <button data-modal-target="mascota-modal" data-modal-toggle="mascota-modal" class="block text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
        Modificar
    </button>
</div>

<!-- Main modal -->
<div id="mascota-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm px-4 pb-4">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 mb-2">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Datos de mascota
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="mascota-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre:</label>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Nombre de la mascota"
                            value="Albóndiga"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="edad" class="block mb-2 text-sm font-medium text-gray-900 ">Edad:</label>
                        <input
                            type="number"
                            name="edad"
                            id="edad"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="5"
                            value="5"
                            required>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="text-white inline-flex items-center bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Modificar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>