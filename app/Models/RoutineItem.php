<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineItem extends Model
{
    use HasFactory;
    protected $fillable= ['routine_id', 'exercise_id', 'note', 'order' , 'rest_timer'];

    public function routine()     {return $this->belongsTo(Routine::class);}
    public function exercise()    {return $this->belongsTo(Exercise::class);}
    public function routineSets() {return $this->hasMany(RoutineSet::class); }

}
