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
        <input type="hidden" name="type" value="computer"> <!-- Hidden field to specify the type -->
        <x-create-edit-label>
            Title:
            <input type="text" name="title" placeholder="Title" required value="{{ old('title') }}">
        </x-create-edit-label>
        <x-create-edit-label>
            Price:
            <input type="number" name="price" placeholder="Price" required value="{{ old('price') }}">
        </x-create-edit-label>

        <!-- Computer-specific fields -->

        <x-create-edit-label>
            Processor:
            <input type="text" name="cpu" placeholder="CPU" required value="{{ old('cpu') }}">
        </x-create-edit-label>
        <x-create-edit-label>
            Graphics Card:
            <input type="text" name="gpu" placeholder="GPU" required value="{{ old('gpu') }}">
        </x-create-edit-label>
        <x-create-edit-label>
            RAM (in GB):
            <input type="number" name="ram" placeholder="RAM" required value="{{ old('ram') }}">
        </x-create-edit-label>
        <x-create-edit-label>
            Storage (in GB):
            <input type="number" name="storage" placeholder="Storage" required value="{{ old('storage') }}">
        </x-create-edit-label>

        
        <button type="submit">Create Computer</button>
    </form>
</x-layout>