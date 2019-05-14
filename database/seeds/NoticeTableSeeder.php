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
                'long' => $noti['long']
            ]);
            $notice->save();
        }
    }
}
