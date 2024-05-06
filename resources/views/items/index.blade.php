<x-layout title="Every Item">
    @foreach ($items as $item)
        <x-item-container>
            <p>Title: {{ $item->title }}</p>
            <p>Price: ${{ $item->price }}</p>

            @if ($item->itemable_type === 'App\Models\Car')
                @php
                    $car = $cars->where('id', $item->itemable_id)->first();
                @endphp

                @if ($car)
                    @include('components.car-info', ['car' => $car])
                @endif
            @endif

            @if ($item->itemable_type === 'App\Models\Computer')
                @php
                    $computer = $computers->where('id', $item->itemable_id)->first();
                @endphp

                @if ($computer)
                    @include('components.computer-info', ['computer' => $computer])
                @endif
            @endif

            <p>Uploaded by: {{ $item->user->name }}</p>
            <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            <a href="{{ route('items.edit', $item->id) }}">Edit</a>
        </x-item-container>
    @endforeach
</x-layout>