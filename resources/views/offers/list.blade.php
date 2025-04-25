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
                        <button @click="window.location.href = '{{ route('offers.create') }}'"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                + Add Offer BLADE
                        </button>
                    </div>
                    <!-- New offer button and modal - VUE.JS -->
                    <div id="app">
                        <add-offer-modal></add-offer-modal>
                    </div>
                </div>
            </div>
        </x-slot>

        <!-- Success message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- User offers list -->
        <div class="py-6">
            <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
                @forelse ($userOffers as $offer)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-3 flex flex-col space-y-2 transition hover:shadow-lg">
                        @php
                            $thumbnail = $offer->photos->first()->path ?? null;
                        @endphp

                        @if ($thumbnail)
                            <img src="{{ asset('storage/' . $thumbnail) }}"
                                alt="{{ $offer->title }}"
                                class="rounded-xl h-36 object-cover w-full">
                        @else
                            <div class="bg-gray-100 h-36 flex items-center justify-center text-gray-400 rounded-xl">
                                No image
                            </div>
                        @endif

                        <h3 class="text-lg font-bold text-gray-800 truncate">{{ $offer->title }}</h3>

                        <div class="text-sm text-gray-700">
                            <span class="font-medium">Price:</span>
                            {{ number_format($offer->price, 2) }} {{ $offer->currency->code ?? '' }}
                        </div>


                        @if(auth()->user()->id == $offer->user_id)
                            <div class="text-sm">
                                <span class="font-medium text-gray-700">Visible:</span> 
                                <span class="{{ $offer->visible ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $offer->visible ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        @endif

                        <div class="mt-auto pt-2 text-right">
                            <a href="{{ route('offers.show', $offer->id) }}"
                            class="text-sm text-blue-600 font-medium hover:underline">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">You have no offers yet.</p>
                @endforelse
            </div>
        </div>

    </x-app-layout>
</div>