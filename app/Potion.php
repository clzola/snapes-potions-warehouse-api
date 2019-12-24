<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Potion
 *
 * @property int $id
 * @property string $name
 * @property array $other_names
 * @property int $potion_category_id
 * @property string $effect
 * @property array $characteristics
 * @property array|null $side_effects
 * @property string $brewing_time
 * @property int $potion_difficulty_level_id
 * @property string $description
 * @property string $picture
 * @property int $bottles
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\PotionCategory $potionCategory
 * @property-read \App\PotionDifficultyLevel $potionDifficultyLevel
 * @property-read \App\PotionRecipe $potionRecipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereBottles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereBrewingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereCharacteristics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereEffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereOtherNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion wherePotionCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion wherePotionDifficultyLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereSideEffects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Potion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Potion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'potions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'other_names',
        'potion_category_id',
        'effect',
        'characteristics',
        'side_effects',
        'brewing_time',
        'potion_difficulty_level_id',
        'description',
        'bottles',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'other_names' => 'array',
        'potion_category_id' => 'integer',
        'characteristics' => 'array',
        'side_effects' => 'array',
        'potion_difficulty_level_id' => 'integer',
        'bottles' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function potionCategory()
    {
        return $this->belongsTo(PotionCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function potionDifficultyLevel()
    {
        return $this->belongsTo(PotionDifficultyLevel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function potionRecipe()
    {
        return $this->hasOne(PotionRecipe::class);
    }
}
