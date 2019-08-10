<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //protected $table='tasks';
    protected $fillable = [
        'name', 'description', 'to_do_date'
    ];
    
}
