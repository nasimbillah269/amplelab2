<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EmiCharge extends Model
{
     protected $fillable = [
        'bank_name',
        'month_3','month_6','month_9','month_12',
        'month_18','month_24','month_36'
    ];

}
