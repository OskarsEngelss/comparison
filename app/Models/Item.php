<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'price'];

    public function itemable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function search(Request $request)
    {
        // Retrieve selected checkboxes from the request
        $selectedRelationships = $request->input('relationships');

        // If no checkboxes are selected, show all items
        if (empty($selectedRelationships)) {
            $items = Item::all();
        } else {
            // Construct a query to search for items with selected relationships
            $items = Item::whereHasMorph('related', $selectedRelationships, function ($query) {
                // Additional conditions if needed
            })->get();
        }

        // Pass the results to the view
        return view('search-results', compact('items'));
    }
}
