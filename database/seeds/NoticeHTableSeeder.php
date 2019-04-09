<?php

use Illuminate\Database\Seeder;
use App\HNotice;

class NoticeHTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_images')->delete();
        DB::table('h_coordinates')->delete();
        DB::table('h_times')->delete();
        DB::table('h_notices')->delete();

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
