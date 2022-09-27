<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Routine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=['user_id', 'title'];

    public function user()  {return $this->belongsTo(User::class); }
    public function routineItems() {return $this->hasMany(RoutineItem::class); }
}
