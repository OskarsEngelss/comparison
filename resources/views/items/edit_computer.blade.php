<x-layout title="Edit Computer Item">
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="computer"> <!-- Hidden field to specify the type -->
        <input type="text" name="title" value="{{ $item->title }}" placeholder="Title" required>
        <input type="number" name="price" value="{{ $item->price }}" placeholder="Price" required>
        <!-- Computer-specific fields -->
        <input type="text" name="cpu" value="{{ $item->itemable->cpu }}" placeholder="CPU" required>
        <input type="text" name="gpu" value="{{ $item->itemable->gpu }}" placeholder="GPU" required>
        <input type="number" name="ram" value="{{ $item->itemable->ram }}" placeholder="RAM" required>
        <input type="number" name="storage" value="{{ $item->itemable->storage }}" placeholder="Storage" required>
        <button type="submit">Update Computer</button>
    </form>
</x-layout>