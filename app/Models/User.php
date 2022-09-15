<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['plan_id', 'name', 'gender', 'mobile', 'weight', 'height', 'birthdate', 'plan_expire_at', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plan()          {return $this->belongsTo(Plan::class);}
    public function exercises()     {return $this->hasMany(Exercise::class);}

    public function last_login()    {return Jalalian::forge($this->last_login)->ago();}
    public function created_at()    {return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');}

    public function avatar($collection = 'avatar')
    {
        return  (strlen($this->getFirstMedia($collection)?->getUrl()) > 0
            &&
            file_exists( $this->getFirstMedia($collection)->getUrl()))
            ? $this->getFirstMedia($collection)->getUrl()
            : Avatar::{$this->gender}();
    }

    public function gender()
    {
        return $this->gender == 'male'
            ? 'آقا'
            : 'خانم';
    }


    public function genderIcon()
    {
        return $this->gender == 'male'
            ? asset("images/static/genders/male.png")
            : asset("images/static/genders/female.png");
    }
}
