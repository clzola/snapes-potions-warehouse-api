<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PotionDifficultyLevel
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionDifficultyLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PotionDifficultyLevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'potion_difficulty_levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
}
