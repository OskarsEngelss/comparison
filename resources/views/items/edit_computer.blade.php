<x-layout title="Edit Computer Item">
    <form class="create-item-form" action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="computer"> <!-- Hidden field to specify the type -->
        
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
        
        <!-- Computer-specific fields -->
        <x-create-edit-label>
            Processor:
            <input type="text" name="cpu" value="{{ old('cpu', $item->itemable->cpu) }}" placeholder="CPU" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Graphics Card:
            <input type="text" name="gpu" value="{{ old('gpu', $item->itemable->gpu) }}" placeholder="GPU" required>
        </x-create-edit-label>
        <x-create-edit-label>
            RAM (in GB):
            <input type="number" name="ram" value="{{ old('ram', $item->itemable->ram) }}" placeholder="RAM" required>
        </x-create-edit-label>
        <x-create-edit-label>
            Storage (in GB):
            <input type="number" name="storage" value="{{ old('storage', $item->itemable->storage) }}" placeholder="Storage" required>
        </x-create-edit-label>
        
        <button type="submit">Update Computer</button>
    </form>
</x-layout>
