<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Image;

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

    public function images() {
        return $this->hasMany('App\Image');
    }

    // Creación de un usuario
    public function create(array $data) {
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->tlf = $data['tlf'];
        $user->categoria = $data['categoria'];

        $user->save();
    }

    // Lectura de un usuario
    public function read(int $id) {
        $user = User::find($id);

        return $user;
    }

    // Lectura de todos los usuario
    public function readAll() {
        $users = User::all();

        return $users;
    }

    // Actualización de un usuario
    public function update() {
        
    }

    // Eliminación de un usuario
    public function delete(int $id) {
        $user = User::find($id);
        $user->delete();
    }

    // Comprobar si un usuario existe
    public function exists(string $tlf) {
        $user = User::where('tlf', '=', $tlf)->get();

        if (count($user) >= 1) {
            return true;
        }
        else {
            return false;
        }
    }

    // Lectura de un usuario por tlf
    public function readByTlf(string $tlf) {
        $user = User::where('tlf', '=', $tlf)->get();

        return $user;
    }
}
