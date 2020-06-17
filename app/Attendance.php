<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'justification','type', 'hours', 'date','student_id','module_id'
    ];
    
}
