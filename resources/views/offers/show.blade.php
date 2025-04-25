<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $offer->title }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow space-y-6">
            @if ($offer->photos->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($offer->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->path) }}"
                             alt="Offer photo"
                             class="rounded w-full h-64 object-cover">
                    @endforeach
                </div>
            @else
                <div class="text-gray-500">No images available for this offer.</div>
            @endif

            <div>
                <h3 class="text-lg font-semibold mb-1">Description</h3>
                <p class="text-gray-700">{{ $offer->description }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p><span class="font-medium">Price:</span> {{ number_format($offer->price, 2) }} {{ $offer->currency->code ?? '' }}</p>
                    
                    <p><span class="font-medium">E-mail:</span> {{ $offer->user->email}}</p>
                    <p><span class="font-medium">Phone number:</span> {{ $offer->user->phone}}</p>

                    @if(auth()->user()->id == $offer->user_id)
                        <br>
                        <p><span class="font-medium text-opacity-10">Offer visible:</span> 
                            <span class="{{ $offer->visible ? 'text-green-600' : 'text-red-500' }}">
                                {{ $offer->visible ? 'Yes' : 'No' }}
                            </span>
                        </p>
                        <p><span class="font-medium">Show Phone:</span>
                            <span class="{{ $offer->show_phone ? 'text-green-600' : 'text-red-500' }}">
                                {{ $offer->show_phone ? 'Yes' : 'No' }}
                            </span>
                        </p>
                    @endif
                </div>

                @if ($offer->categories->count())
                    <div>
                        <p class="font-medium mb-1">Categories:</p>
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach ($offer->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            @if(auth()->user()->id == $offer->user_id)
                <div class="text-right">
                    <a href="{{ route('offers.edit',$offer->id) }}" class="text-orange-600 hover:underline">Edit offer</a>
                </div>
            @endif

            <div class="text-right">
                @if(auth()->user()->id == $offer->user_id)
                    <a href="{{ route('offers.list') }}" class="text-blue-600 hover:underline">← Back to offers</a>
                @else
                    <a href="{{ route('marketplace') }}" class="text-blue-600 hover:underline">← Back to offers</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
