<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Car;
use App\Models\Computer;

class ItemController extends Controller
{
    public function index() 
    {
        $items = Item::all();
        $computers = Computer::all();
        $cars = Car::all();
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
            $item->itemable()->associate($computer);
            $item->save();
        }

        return redirect("/");
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}