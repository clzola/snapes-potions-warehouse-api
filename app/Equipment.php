<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * \App\Equipment
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $picture_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Equipment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "equipments";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];


    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPictureUrlAttribute()
    {
        return url("storage/equipments/pictures/{$this->picture}");
    }
}
