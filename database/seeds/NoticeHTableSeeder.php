<?php

use Illuminate\Database\Seeder;

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
            $notice = new HNotice([
                'fecha' => $noti['fecha'],
                'valoracion' => $noti['valoracion'],
                'visto' => $noti['visto']
            ]);
            $notice->save();
        }
    }
}
