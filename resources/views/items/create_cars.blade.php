<x-layout title="Create">
    <form class="create-item-form" action="{{ route('items.store') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="validation-error-div">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="hidden" name="type" value="car"> <!-- Hidden field to specify the type -->
        <x-create-edit-label>
            Title:
            <input type="text" name="title" placeholder="Title" value="{{ old('title') }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Price:
            <input type="text" name="price" placeholder="Price" value="{{ old('price') }}" required>
        </x-create-edit-label>

        <!-- Car-specific fields -->

        <x-create-edit-label>
            Manufacturer:
            <input type="text" name="manufacturer" placeholder="Manufacturer" value="{{ old('manufacturer') }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Release Date:
            <input type="date" name="release_date" value="{{ old('release_date') }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Fuel Economy:
            <input type="number" name="fuel_economy" placeholder="Fuel Economy" value="{{ old('fuel_economy') }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Maximum Speed (in km/h):
            <input type="number" name="max_speed" placeholder="Max Speed" value="{{ old('max_speed') }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Weight (in kg):
            <input type="number" name="weight" placeholder="Weight" value="{{ old('weight') }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Size (Length by Width by Height):
            <input type="text" name="size" placeholder="Size" value="{{ old('size') }}" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Miscellaneous Information:
            <input type="text" name="misc_info" placeholder="Misc Info" value="{{ old('misc_info') }}">
        </x-create-edit-label>
    
        <button type="submit">Create Car</button>
    </form>
</x-layout>