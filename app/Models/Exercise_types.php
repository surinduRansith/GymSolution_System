<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise_types extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'exercise_type'
        
     ];
 
    
}
