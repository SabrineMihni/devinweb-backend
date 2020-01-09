<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryDate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'day_name', 'excluded'
    ];

    protected $hidden = ['id', 'excluded', 'updated_at', 'created_at', 'city_id'];


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
}
