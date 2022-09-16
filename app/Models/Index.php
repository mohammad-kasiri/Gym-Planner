<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use HasFactory;

    protected  $fillable= ['title', 'unit'];

    public function indices()
    {
        return $this->belongsToMany(Type::class,
            'index_type',
            'index_id',
            'type_id');
    }
}
