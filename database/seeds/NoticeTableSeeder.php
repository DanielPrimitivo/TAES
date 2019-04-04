<?php

use Illuminate\Database\Seeder;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("notice.ini", true);
        foreach($info as $noti){
            $notice = new Notice([
                'fecha' => $noti['fecha'],
                'valoracion' => $noti['valoracion'],
                'visto' => $noti['visto']
            ]);
            $notice->save();
        }
    }
}
