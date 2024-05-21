<x-layout title="Every Item">
    <main class="item-main">
        <div class="filter-div">
            <form method="POST" action="{{ route('apply.filters') }}" class="filter-form">
                @csrf
                <label>
                    Show cars:
                    <input type="checkbox" name="show[]" value="car" {{ in_array('car', request('show', [])) ? 'checked' : '' }}> 
                </label>
                <label>
                    Show computers:
                    <input type="checkbox" name="show[]" value="computer" {{ in_array('computer', request('show', [])) ? 'checked' : '' }}> 
                </label>
                <button type="submit">Apply filters</button>
            </form>
            <div class="animation-container">
                <div class="planet"></div>
                <div class="container">
                    <div class="ears"></div>
                    <div class="ears-detail"></div>
                    <div class="head"></div>
                    <div class="eye"></div>
                    <div class="body"></div>
                    <div class="tail"></div>
                    <div class="front-legs"></div>
                    <div class="back-legs"></div>
                </div>
            </div>
        </div>

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
                    @if ($item->user_id == Auth::id() || (Auth::check() && Auth::user()->admin))
                        <div class="item-author-options">
                            <button type="button" class="edit-button" data-url="{{ route('items.edit', $item->id) }}">Edit</button>
                            <form class="item-form-delete" action="{{ route('items.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="delete-button" type="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                </x-item-container>
            @endforeach
        </div>
    </main>

    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                window.location.href = this.dataset.url;
            });
        });
    </script>
</x-layout>