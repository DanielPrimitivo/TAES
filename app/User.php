<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    // Creación de un usuario
    public function createUSU(array $data) {
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();
    }

    // Lectura de un usuario
    public function readUSU(int $id) {
        $user = User::find($id);

        return $user;
    }

    // Lectura de todos los usuario
    public function readAll() {
        $users = User::all();

        return $users;
    }

    // Actualización de un usuario
    public function updateUSU() {
        
    }

    // Eliminación de un usuario
    public function deleteUSU(int $id) {
        $user = User::find($id);
        $user->delete();
    }
}
