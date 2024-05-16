<x-layout title="Every Item">
    <main class="item-main">
        <div class="filter-div">
            <form method="POST" action="{{ route('apply.filters') }}" class="filter-form">
                @csrf
                <label>
                    Show cars:
                    <input type="checkbox" name="show[]" value="car"> 
                </label>
                <label>
                    Show computers:
                    <input type="checkbox" name="show[]" value="computer"> 
                </label>
                <button type="submit">Change filters</button>
            </form>
        </div>

        <div class="item-outer-div">
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
                    @if ($item->user_id == Auth::id())
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <a href="{{ route('items.edit', $item->id) }}">Edit</a>
                    @endif
                </x-item-container>
            @endforeach
        </div>
    </main>
</x-layout>