<x-layout title="Selected Items">
    <main class="item-main">
        <div class="item-outer-div">
            @foreach ($items as $item)
                <x-item-container>
                    <p><x-item-span>Title:</x-item-span> {{ $item->title }}</p>
                    <p><x-item-span>Price:</x-item-span> ${{ $item->price }}</p>

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

                    <p><x-item-span>Uploaded by:</x-item-span> {{ $item->user->name }}</p>
                </x-item-container>
            @endforeach
        </div>
    </main>
</x-layout>
