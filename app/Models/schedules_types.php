<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedules_types extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'scheduleName',
        'scheduleType_id',
 ];

}
