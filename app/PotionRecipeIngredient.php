<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\PotionRecipeIngredient
 *
 * @property int $potion_recipe_id
 * @property int $ingredient_id
 * @property int $amount
 * @property string $measurement_unit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipeIngredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipeIngredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipeIngredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipeIngredient whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipeIngredient whereIngredientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipeIngredient whereMeasurementUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipeIngredient wherePotionRecipeId($value)
 * @mixin \Eloquent
 */
class PotionRecipeIngredient extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'potion_recipe_ingredient';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'potion_recipe_id',
        'ingredient_id',
        'amount',
        'measurement_unit',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'potion_recipe_id' => 'integer',
        'potion_ingredient_id' => 'integer',
        'amount' => 'integer',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
