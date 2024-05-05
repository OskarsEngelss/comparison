<x-layout title="Create">
    <form action="{{ route('items.store') }}" method="post">
        @csrf
        <input type="hidden" name="type" value="car"> <!-- Hidden field to specify the type -->
        <input type="text" name="title" placeholder="Title" required>
        <input type="number" name="price" placeholder="Price" required>
        <!-- Car-specific fields -->
        <input type="text" name="manufacturer" placeholder="Manufacturer" required>
        <input type="date" name="release_date" required>
        <input type="number" name="fuel_economy" placeholder="Fuel Economy" required>
        <input type="number" name="max_speed" placeholder="Max Speed" required>
        <input type="number" name="weight" placeholder="Weight" required>
        <input type="text" name="size" placeholder="Size" required>
        <input type="text" name="misc_info" placeholder="Misc Info">
        <button type="submit">Create Car</button>
    </form>
</x-layout>