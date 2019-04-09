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
        DB::table('images')->delete();
        DB::table('coordinates')->delete();
        DB::table('times')->delete();
        DB::table('notices')->delete();

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
