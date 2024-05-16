<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Car;
use App\Models\Computer;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $computers = Computer::all();
        $cars = Car::all();

        if ($request->has('show')) {
            $selectedOptions = $request->input('show', []);

            $itemsQuery = Item::query();
            $items = (in_array('car', $selectedOptions)) ? Item::where('itemable_type', '=', 'App\Models\Car')->get() : 
                     ((in_array('computer', $selectedOptions)) ? Item::where('itemable_type', '=', 'App\Models\Computer')->get() :
                     []);

        } else {
            $items = Item::all();
        }

        return view('items.index', compact('items', 'computers', 'cars'));
    }

    public function create()
    {
        return view('create_item'); // Display the form for creating a new item
    }

    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|in:car,computer', // Add a hidden field in your form to specify the type
        ]);

        if ($request->type === 'car') {
            $request->validate([
                'manufacturer' => 'required|string',
                'release_date' => 'required|date',
                'fuel_economy' => 'required|numeric',
                'max_speed' => 'required|numeric',
                'weight' => 'required|numeric',
                'size' => 'required|string',
                'misc_info' => 'nullable|string',
            ]);

            $car = Car::create([
                'manufacturer' => $request->manufacturer,
                'release_date' => $request->release_date,
                'fuel_economy' => $request->fuel_economy,
                'max_speed' => $request->max_speed,
                'weight' => $request->weight,
                'size' => $request->size,
                'misc_info' => $request->misc_info,
            ]);
            $item = new Item([
                'title' => $request->title,
                'price' => $request->price,
            ]);
            $item->user_id = Auth::id();
            $item->itemable()->associate($car);
            $item->save();
        } elseif ($request->type === 'computer') {
            $request->validate([
                'cpu' => 'required|string',
                'gpu' => 'required|string',
                'ram' => 'required|integer',
                'storage' => 'required|integer',
            ]);

            $computer = Computer::create([
                'cpu' => $request->cpu,
                'gpu' => $request->gpu,
                'ram' => $request->ram,
                'storage' => $request->storage,
            ]);
            $item = new Item([
                'title' => $request->title,
                'price' => $request->price,
            ]);
            $item->user_id = Auth::id();
            $item->itemable()->associate($computer);
            $item->save();
        }

        return redirect("/");
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        $type = $item->itemable_type;

        if ($type === 'App\Models\Car') {
            return view('items.edit_car', compact('item'));
        } elseif ($type === 'App\Models\Computer') {
            return view('items.edit_computer', compact('item'));
        }
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->update([
            'title' => $request->title,
            'price' => $request->price,
        ]);

        if ($item->itemable_type === 'App\Models\Car') {
            $car = $item->itemable;
            $car->update([
                'manufacturer' => $request->manufacturer,
                'release_date' => $request->release_date,
                'fuel_economy' => $request->fuel_economy,
                'max_speed' => $request->max_speed,
                'weight' => $request->weight,
                'size' => $request->size,
                'misc_info' => $request->misc_info,
            ]);
        } elseif ($item->itemable_type === 'App\Models\Computer') {
            $computer = $item->itemable;
            $computer->update([
                'cpu' => $request->cpu,
                'gpu' => $request->gpu,
                'ram' => $request->ram,
                'storage' => $request->storage,
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}