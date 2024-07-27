<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'bid_id',
        'date',
        'time1',
        'time2',
        'time3',
        'time4',
        'time5',
        'time6',
    ];
}
