<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [
        'name', 'type','total','professor','start_date','end_date'
    ];
    
}
