<x-layout title="Create">
    <form action="{{ route('items.store') }}" method="post">
        @csrf
        <input type="hidden" name="type" value="computer"> <!-- Hidden field to specify the type -->
        <input type="text" name="title" placeholder="Title" required>
        <input type="number" name="price" placeholder="Price" required>
        <!-- Computer-specific fields -->
        <input type="text" name="cpu" placeholder="CPU" required>
        <input type="text" name="gpu" placeholder="GPU" required>
        <input type="number" name="ram" placeholder="RAM" required>
        <input type="number" name="storage" placeholder="Storage" required>
        <button type="submit">Create Computer</button>
    </form>
</x-layout>