<x-layout title="Edit Car Item">
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="car"> <!-- Hidden field to specify the type -->
        <input type="text" name="title" value="{{ $item->title }}" placeholder="Title" required>
        <input type="number" name="price" value="{{ $item->price }}" placeholder="Price" required>
        <!-- Car-specific fields -->
        <input type="text" name="manufacturer" value="{{ $item->itemable->manufacturer }}" placeholder="Manufacturer" required>
        <input type="date" name="release_date" value="{{ $item->itemable->release_date }}" required>
        <input type="number" name="fuel_economy" value="{{ $item->itemable->fuel_economy }}" placeholder="Fuel Economy" required>
        <input type="number" name="max_speed" value="{{ $item->itemable->max_speed }}" placeholder="Max Speed" required>
        <input type="number" name="weight" value="{{ $item->itemable->weight }}" placeholder="Weight" required>
        <input type="text" name="size" value="{{ $item->itemable->size }}" placeholder="Size" required>
        <input type="text" name="misc_info" value="{{ $item->itemable->misc_info }}" placeholder="Misc Info">
        <button type="submit">Update Car</button>
    </form>
</x-layout>