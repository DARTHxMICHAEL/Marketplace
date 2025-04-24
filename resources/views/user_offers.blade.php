<div x-data="{ open: false }">
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('My offers') }}
                </h2>
                <div class="flex space-x-2">
                    <!-- New offer button - BLADE -->
                    <div>
                        <button @click="open = true"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            + Add Offer BLADE
                        </button>
                    </div>
                    <!-- New offer button - VUE.JS -->
                    <div id="app">
                        <add-offer-modal></add-offer-modal>
                    </div>
                </div>
            </div>
        </x-slot>

        <!-- Main content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("Offer one") }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="open" 
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
            style="display: none;">
            <div class="bg-white p-6 rounded shadow w-full max-w-lg">
                <h2 class="text-lg font-semibold mb-4">Add Offer</h2>
                <p class="text-sm text-gray-600">[Form goes here later]</p>
                <div class="text-right mt-4">
                    <button @click="open = false" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
