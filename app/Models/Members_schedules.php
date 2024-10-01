<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members_schedules extends Model
{
    use HasFactory;

    protected $fillable = [

        'member_id',
        'scheduleType_id',
    ];
}
