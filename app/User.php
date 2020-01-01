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
    protected $fillable = [
        'username', 'email', 'password', 'fullname', 'jk', 'hp', 'nip', 'level', 'jk', 'role'
    ];

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

    public function jadwals()
    {
        return $this->hasMany(\App\Jadwal, 'guru_id', 'nip');
    }

    public function jurnals()
    {
        return $this->hasMany('App\Jurnal', 'staf_id', 'nip');
    }
    public static function boot()
    {
        parent::boot();
        self::deleting(function($user) {
            $user->jadwals()->each(function($jadwal) {
                $jadwal->delete();
            });
        });
    }

    public function logabsens()
    {
        $this->hasMany('App\LogAbsen', 'guru_id', 'nip');
    }
}
