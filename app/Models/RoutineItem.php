<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineItem extends Model
{
    use HasFactory;
    protected $fillable= ['routine_id', 'exercise_id', 'user_id', 'note', 'order'];
}
