<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PotionCategory
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Potion[] $potions
 * @property-read int|null $potions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PotionCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "potion_categories";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "description",
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function potions()
    {
        return $this->hasMany(Potion::class);
    }
}
