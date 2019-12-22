<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ingredient
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property int $amount
 * @property string $measurement_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient whereMeasurementUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ingredient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ingredient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "ingredients";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
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
