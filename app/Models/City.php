<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    protected $hidden = ['deleted_at'];

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
