<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'estate_id', 'city_id', 'father_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function city () {
        return $this->belongsTo(City::class);
    }

    public function estate () {
        return $this->belongsTo(Estate::class);
    }

    public function father () {
        return $this->belongsTo(User::class, 'father_id');
    }

    public function web () {
        
        $web = $this->webRec(array(), 0);

        return [
            "name" => $this->name,
            "web" => $web
        ];
    }

    public function webRec ($test, $level) {

        $level++;

        $users = User::where('father_id', $this->id)->get();

        foreach($users as $u) {

            $lala = [ $level, $u->name ];

            array_push($test, $lala);

            $test = $u->webRec($test, $level);
        }

        return $test;
    }

}
