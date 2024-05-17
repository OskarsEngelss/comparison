<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Car;
use App\Models\Computer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $computers = Computer::all();
        $cars = Car::all();

        $selectedOptions = $request->input('show', []);

        $itemsQuery = Item::query();
        if (in_array('car', $selectedOptions)) {
            $itemsQuery->orWhere('itemable_type', 'App\Models\Car');
        }
        if (in_array('computer', $selectedOptions)) {
            $itemsQuery->orWhere('itemable_type', 'App\Models\Computer');
        }

        $items = $itemsQuery->get();

        return view('items.index', compact('items', 'computers', 'cars'));
    }

    public function create()
    {
        return view('create_item');
    }

    public function store(Request $request)
    {
        $baseRules = [
            'title' => 'required|string|max:30',
            'price' => 'required|numeric|min:0|max:999999.99',
            'type' => 'required|in:car,computer',
        ];

        if ($request->type === 'car') {
            $carRules = [
                'manufacturer' => 'required|string|max:100',
                'release_date' => 'required|date',
                'fuel_economy' => 'required|numeric|max:999999.99',
                'max_speed' => 'required|numeric|max:999999.99',
                'weight' => 'required|numeric|max:999999.99',
                'size' => 'required|string',
                'misc_info' => 'nullable|string|max:999',
            ];
            $validator = Validator::make($request->all(), array_merge($baseRules, $carRules));
        } elseif ($request->type === 'computer') {
            $computerRules = [
                'cpu' => 'required|string|max:255',
                'gpu' => 'required|string|max:255',
                'ram' => 'required|integer|max:9999999',
                'storage' => 'required|integer|max:9999999',
            ];
            $validator = Validator::make($request->all(), array_merge($baseRules, $computerRules));
        }
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }


        if ($request->type === 'car') {
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

        $baseRules = [
            'title' => 'required|string|max:30',
            'price' => 'required|numeric|min:0|max:999999.99',
        ];

        if ($item->itemable_type === 'App\Models\Car') {
            $carRules = [
                'manufacturer' => 'required|string|max:100',
                'release_date' => 'required|date',
                'fuel_economy' => 'required|numeric|max:999999.99',
                'max_speed' => 'required|numeric|max:999999.99',
                'weight' => 'required|numeric|max:999999.99',
                'size' => 'required|string',
                'misc_info' => 'nullable|string|max:999',
            ];
            $validator = Validator::make($request->all(), array_merge($baseRules, $carRules));
        } elseif ($item->itemable_type === 'App\Models\Computer') {
            $computerRules = [
                'cpu' => 'required|string|max:255',
                'gpu' => 'required|string|max:255',
                'ram' => 'required|integer|max:9999999',
                'storage' => 'required|integer|max:9999999',
            ];
            $validator = Validator::make($request->all(), array_merge($baseRules, $computerRules));
        }
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

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

    public function checkItems(Request $request)
    {
        $selectedItemIds = $request->input('selected_items', []);

        if (empty($selectedItemIds)) {
            return back()->withErrors(['message' => 'No items selected.']);
        }

        $items = Item::whereIn('id', $selectedItemIds)->get();

        $firstItemableType = $items->first()->itemable_type;

        foreach ($items as $item) {
            if ($item->itemable_type !== $firstItemableType) {
                return back()->withErrors(['message' => 'Selected items must be of the same type.']);
            }
        }

        return redirect()->route('items.showSelected')->with('selectedItems', $items);
    }

    public function showSelected(Request $request)
    {
        $items = $request->session()->get('selectedItems', []);

        if (empty($items)) {
            return redirect()->route('items.index')->withErrors(['message' => 'No items to display.']);
        }

        return view('items.selected', ['items' => $items]);
    }
    public function testForm(Request $request)
{
    dd($request->all());
}
}