<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class Exercise extends Model
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['user_id', 'type_id', 'equipment_id', 'primary_muscle_id', 'other_muscles', 'fa_title', 'en_title', 'keywords', 'is_public'];

    protected $casts = [
        'other_muscles' => 'array',
    ];

    public function user()                 {return $this->belongsTo(User::class);}
    public function type()                 {return $this->belongsTo(Type::class);}
    public function equipment()            {return $this->belongsTo(Equipment::class);}
    public function primary_muscle()       {return $this->belongsTo(Muscle::class , 'primary_muscle_id');}


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
