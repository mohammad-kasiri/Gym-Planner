<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineSet extends Model
{
    use HasFactory;
    protected $fillable = ['routine_item_id', 'amount'];

    protected $casts = [
        'amount' => 'array',
    ];
}
