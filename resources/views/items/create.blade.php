<x-layout title="Create">
    <div class="create-option-div">
        <form action="{{ route('cars.create') }}">
            @csrf
            <button type="submit">Create Car</button>
        </form>
        <form action="{{ route('computers.create') }}">
            @csrf
            <button type="submit">Create Computer</button>
        </form>
    </div>
</x-layout>