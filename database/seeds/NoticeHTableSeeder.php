<?php

use Illuminate\Database\Seeder;
use App\Hnotice;

class NoticeHTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("noticeh.ini", true);
        foreach($info as $noti){
            $notice = new Hnotice([
                'fecha' => $noti['fecha'],
                'categoria' => $noti['categoria'],
                'visto' => $noti['visto'],
                'lat' => $noti['lat'],
                'long' => $noti['long'],
                'hect' => $noti['hect'], //cantidad de hectareas quemadas
                'magn' => $noti['magn'],
                'prec' => $noti['prec'], //cantidad de precipitaciones L/m^2
                'afect' => $noti['afect'], //cantidad de personas afectadas
                'danyos' => $noti['danyos'] //cantidad en daños materiales 
            ]);
            $notice->save();
        }
    }
}
