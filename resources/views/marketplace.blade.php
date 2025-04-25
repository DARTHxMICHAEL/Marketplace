<x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Marketplace') }}
                </h2>
            </div>
        </x-slot>

        <!-- Filter + Search -->
        <div class="max-w-5xl mx-auto px-4 mb-6 pt-5">
            <form method="GET" action="{{ route('marketplace') }}" class="flex flex-wrap gap-4 items-center">

                <!-- Search -->
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-input flex-1 px-4 py-2 rounded border-gray-300"
                    placeholder="Search by title...">

                <!-- Category -->
                <select name="category" class="form-select px-4 py-2 rounded border-gray-300 w-1/5">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        <!-- Success message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- User offers list -->
        <div class="py-6">
            <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
                @forelse ($offers as $offer)
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

                        <div class="mt-auto pt-2 text-right">
                            <a href="{{ route('offers.show', $offer->id) }}"
                            class="text-sm text-blue-600 font-medium hover:underline">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">There are no offers yet.</p>
                @endforelse
            </div>
        </div>

    </x-app-layout>