<x-layout title="Edit Car Item">
    <form class="create-item-form" action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="car"> <!-- Hidden field to specify the type -->
        
        @if ($errors->any())
            <div class="validation-error-div">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <x-create-edit-label>
            Title:
            <input type="text" name="title" value="{{ old('title', $item->title) }}" placeholder="Title" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Price:
            <input type="text" name="price" value="{{ old('price', $item->price) }}" placeholder="Price" required>
        </x-create-edit-label>
        
        <!-- Car-specific fields -->
        <x-create-edit-label>
            Manufacturer:
            <input type="text" name="manufacturer" value="{{ old('manufacturer', $item->itemable->manufacturer) }}" placeholder="Manufacturer" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Release Date:
            <input type="date" name="release_date" value="{{ old('release_date', $item->itemable->release_date) }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Fuel Economy:
            <input type="number" name="fuel_economy" value="{{ old('fuel_economy', $item->itemable->fuel_economy) }}" placeholder="Fuel Economy" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Max Speed:
            <input type="number" name="max_speed" value="{{ old('max_speed', $item->itemable->max_speed) }}" placeholder="Max Speed" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Weight:
            <input type="number" name="weight" value="{{ old('weight', $item->itemable->weight) }}" placeholder="Weight" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Size:
            <input type="text" name="size" value="{{ old('size', $item->itemable->size) }}" placeholder="Size" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Misc Info:
            <input type="text" name="misc_info" value="{{ old('misc_info', $item->itemable->misc_info) }}" placeholder="Misc Info">
        </x-create-edit-label>
        
        <button type="submit">Update Car</button>
    </form>
</x-layout>
