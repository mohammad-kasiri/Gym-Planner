<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class Exercise extends Model
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['user_id', 'type_id', 'equipment_id', 'primary_muscle_id', 'secondary_muscle_id', 'fa_title', 'en_title', 'keywords', 'is_public'];

    public function user()                 {return $this->belongsTo(User::class);}
    public function type()                 {return $this->belongsTo(Type::class);}
    public function equipment()            {return $this->belongsTo(Equipment::class);}
    public function primary_muscle()       {return $this->belongsTo(Muscle::class , 'primary_muscle_id');}
    public function secondary_muscle()     {return $this->belongsTo(Muscle::class , 'secondary_muscle_id');}

    //public function primary_muscles()      {return $this->belongsToMany(Muscle::class,
    //                                                                    'exercise_primary_muscle',
    //                                                                    'exercise_id',
    //                                                                    'muscle_id');}
//
    //public function secondary_muscles()    {return $this->belongsToMany(Muscle::class,
    //                                                                    'exercise_primary_muscle',
    //                                                                    'exercise_id',
    //                                                                    'muscle_id');}

    public function scopePublic($query)
    {
        return $query->where('is_public', '=', true);
    }

    public function setImage()
    {
        if (request()->hasFile('image')) {
            $this->media()->delete();
            $this->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }
    }
}
