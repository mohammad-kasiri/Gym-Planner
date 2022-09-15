<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable= ['parent_id', 'title', 'days', 'price'];

    public function parent()    {return $this->belongsTo(static::class, 'parent_id');}
    public function children()  {return $this->hasMany  (static::class, 'parent_id');}
}
