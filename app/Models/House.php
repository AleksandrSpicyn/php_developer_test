<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class House
 * @property int id
 * @property string name
 * @property int price
 * @property int bedrooms
 * @property int bathrooms
 * @property int storeys
 * @property int garages
 */
class House extends Model
{
    use HasFactory;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'string|required',
        'price' => 'integer|required',
        'bedrooms' => 'integer|required',
        'bathrooms' => 'integer|required',
        'storeys' => 'integer|required',
        'garages' => 'integer|required',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages',
    ];
}
