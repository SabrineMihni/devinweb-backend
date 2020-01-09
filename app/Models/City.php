<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Get the partner.
     */
    public function partner()
    {
        return $this->hasOne('App\Models\Partner');
    }

    /**
     *
     */
    public function deliveryDates()
    {
        return $this->hasMany('App\Models\DeliveryDate');
    }

    /**
     *
     */
    public function deliveryTimes()
    {
        return $this->hasMany('App\Models\DeliveryTime');
    }
}
