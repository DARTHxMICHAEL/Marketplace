<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create a New Offer') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
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
            <form method="POST" action="{{ route('offers.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Title</label>
                    <input type="text" name="title" class="form-input w-full" 
                    value="{{ old('title') }}" maxlength="90" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Description</label>
                    <textarea name="description" class="form-textarea w-full" rows="4" 
                    maxlength="500" required>{{ old('description') }}</textarea>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" class="form-input w-full" value="{{ old('price') }}" required>
                </div>

                <!-- Currency -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Currency</label>
                    <select name="currency_id" class="form-select w-full">
                        <option value="">-- Select Currency --</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" {{ old('currency_id') == $currency->id ? 'selected' : '' }}>
                                {{ $currency->code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Show Phone -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="show_phone" id="show_phone" class="mr-2" value="1">
                    <label for="show_phone" class="text-sm text-gray-700">Show Phone Number</label>
                </div>

                <!-- Visible -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="visible" id="visible" class="mr-2" value="1">
                    <label for="visible" class="text-sm text-gray-700">Visible</label>
                </div>

                <!-- Category selection -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Categories (Select multiple)</label>
                    
                    <!-- Improved multi-select with better styling -->
                    <select 
                        name="categories[]" 
                        multiple 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        required
                    >
                        @foreach ($categories as $category)
                            <option 
                                value="{{ $category->id }}" 
                                {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}
                                class="py-2"
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <!-- Help text -->
                    <p class="mt-1 text-xs text-gray-500">
                        Hold Ctrl (Windows) or Command (Mac) to select multiple categories
                    </p>
                </div>

                <!-- Photos Upload -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Upload Photos (max 5)</label>
                    <input type="file" name="photos[]" accept="image/*" multiple class="form-input w-full">
                    <small class="text-gray-500 text-sm">You can select up to 5 images (JPEG, PNG, etc.)</small>
                </div>

                <!-- Submit -->
                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save Offer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
