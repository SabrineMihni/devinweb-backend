<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_at', 'excluded'
    ];

    protected $hidden = [ 'excluded', 'city_id', "delivery_date_id"];

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
}
