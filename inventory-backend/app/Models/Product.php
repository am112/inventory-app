<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'brand',
        'model',
        'capacity',
        'quantity',
    ];

    public const SEARCHABLE = [
        'id',
        'type',
        'brand',
        'model',
        'capacity',
        'quantity'
    ];
}
