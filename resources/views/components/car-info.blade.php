<div class="item-extra-info">
    <p><x-item-span>Manufacturer:</x-item-span> {{ $car->manufacturer }}</p>
    <p><x-item-span>Release Date:</x-item-span> {{ $car->release_date }}</p>
    <p><x-item-span>Fuel Economy (km/l):</x-item-span> {{ $car->fuel_economy }}</p>
    <p><x-item-span>Max Speed (km/h): </x-item-span> {{ $car->max_speed }}</p>
    <p><x-item-span>Weight (kg):</x-item-span> {{ $car->weight }}</p>
    <p><x-item-span>Size:</x-item-span> {{ $car->size }}</p>
    @if ($car->misc_info  !== null)
        <p><x-item-span>Misc Info:</x-item-span> {{ $car->misc_info }}</p>
    @endif
</div>