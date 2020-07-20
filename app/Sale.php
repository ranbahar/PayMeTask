<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'time', 'sale_number', 'description','amount','currency','payment_Link'
    ];

    /**
     * @return mixed
     */
}
