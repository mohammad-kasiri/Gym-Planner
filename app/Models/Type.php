<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable=['title'];

    public function indices()
    {
        return $this->belongsToMany(Index::class,
            'index_type',
            'type_id',
            'index_id');
    }
}
