<?php

namespace App\Models;

use App\Scopes\ExcludedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryTime extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_at', 'excluded'
    ];

    protected $hidden = [ 'excluded', 'city_id', "delivery_date_id", "deleted_at"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the DeliveryDates for the deliveryTime.
     */
    public function deliveryDates()
    {
        return $this->belongsToMany(DeliveryDate::class, 'delivery_date_time', 'delivery_time_id', 'delivery_date_id');
    }

    /**
     *
     */
    public function city()
    {
        return $this->belongsTo(City::class);
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
