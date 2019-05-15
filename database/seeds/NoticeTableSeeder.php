<?php

use Illuminate\Database\Seeder;
use App\Notice;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //arreglar
        $info = parse_ini_file("notice.ini", true);
        foreach($info as $noti){
            $notice = new Notice([
                'fecha' => $noti['fecha'],
                'categoria' => $noti['categoria'],
                'visto' => $noti['visto'],
                'lat' => $noti['lat'],
                'long' => $noti['long'],
                'hect' => $noti['hect'], //cantidad de hectareas quemadas
                'prevhect' => $noti['prevhect'], //prevision de hectareas quemadas (historicos)
                'afect' => $noti['afect'], //cantidad de personas afectadas
                'prevafect' => $noti['prevafect'], //prevision de personas afectadas (historicos)
                'danyos' => $noti['danyos'], //cantidad en daños materiales 
                'prevdanyos' => $noti['prevdanyos'], //prevision de cantidad de daños materiales (historicos)
                'prec' => $noti['prec'], //cantidad de precipitaciones L/m^2
                'prevprec' => $noti['prevprec'] //prevision de precipitaciones L/m^2 (historicos)
            ]);
            $notice->save();
        }
    }
}
