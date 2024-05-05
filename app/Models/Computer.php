<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = ['cpu', 'gpu', 'ram', 'storage'];

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }
}
