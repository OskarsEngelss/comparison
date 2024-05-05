<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'release_date',
        'fuel_economy',
        'max_speed',
        'weight',
        'size',
        'misc_info'
    ];

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }
}
