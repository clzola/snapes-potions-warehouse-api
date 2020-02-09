<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NamedAmount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "named_amounts";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'amount',
        'measurement_unit',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'integer',
    ];
}
