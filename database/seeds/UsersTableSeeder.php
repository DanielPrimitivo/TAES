<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("user.ini", true);
        foreach($info as $tm){
            $time = new User([
                'name' => $tm['name'],
                'email' => $tm['email'],
                'password' => Hash::make($tm['password']),
                'tlf' => $tm['tlf'],
                'categoria' => $tm['categoria']
            ]);
            $time->save();
        }
    }
}
