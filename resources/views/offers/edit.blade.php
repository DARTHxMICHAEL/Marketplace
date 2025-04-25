<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit offer') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">

        <div class="pb-5">
            <a href="{{ route('offers.show', $offer->id) }}" class="text-blue-600 hover:underline pb-5">← Back to offer</a>
        </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <p class="font-semibold mb-2">There were some problems with your input:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('offers.update', $offer->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Title</label>
                <input type="text" name="title" class="form-input w-full" 
                value="{{ old('title', $offer->title) }}" maxlength="90" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" class="form-textarea w-full" rows="4" 
                maxlength="500" required>{{ old('description', $offer->description) }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Price</label>
                <input type="number" step="0.01" name="price" class="form-input w-full" 
                value="{{ old('price', $offer->price) }}" required>
            </div>

            <!-- Currency -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Currency</label>
                <select name="currency_id" class="form-select w-full">
                    <option value="">-- Select Currency --</option>
                    @foreach ($currencies as $currency)
                        <option value="{{ $currency->id }}" 
                            {{ (old('currency_id', $offer->currency_id) == $currency->id) ? 'selected' : ''}}>
                            {{ $currency->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Show Phone -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="show_phone" id="show_phone" class="mr-2" value="1"
                    {{ old('show_phone', $offer->show_phone) ? 'checked' : '' }}>
                <label for="show_phone" class="text-sm text-gray-700">Show Phone Number</label>
            </div>

            <!-- Visible -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="visible" id="visible" class="mr-2" value="1"
                    {{ old('visible', $offer->visible) ? 'checked' : '' }}>
                <label for="visible" class="text-sm text-gray-700">Visible</label>
            </div>

            <!-- Category selection -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700 mb-1">Categories (Select multiple)</label>
                <select name="categories[]" multiple class="form-multiselect w-full" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ in_array($category->id, old('categories', $offer->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Existing Photos -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Current Photos</label>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($offer->photos as $photo)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $photo->path) }}" class="h-24 w-24 object-cover rounded">
                            <button type="button" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center"
                                onclick="confirm('Are you sure?') && this.closest('div').remove()">
                                ×
                            </button>
                            <input type="hidden" name="existing_photos[]" value="{{ $photo->id }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- New Photos Upload -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Add More Photos (max 5 total)</label>
                <input type="file" name="photos[]" accept="image/*" multiple class="form-input w-full">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Offer
                </button>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>
