<?php

namespace App\Models;

use App\Scopes\ExcludedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryDate extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'day_name', 'excluded'
    ];

    protected $hidden = ['id', 'excluded', 'updated_at', 'created_at', 'city_id', "deleted_at"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     *
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     *
     */
    public function deliveryTimes()
    {
        return $this->hasMany('App\Models\DeliveryTime');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ExcludedScope);
    }
}
