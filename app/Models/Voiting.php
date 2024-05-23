<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voiting extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_musician_id',
        'second_musician_id',
        'end_date',
        'is_published',
    ];

}
