<?php

use Illuminate\Database\Seeder;
use App\Time;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('times')->delete();

        $info = parse_ini_file("time.ini", true);
        foreach($info as $tm){
            $time = new Time([
                'viento' => $tm['viento'],
                'dirviento' => $tm['dirviento'],
                'humedad' => $tm['humedad'],
                'temperatura' => $tm['temperatura'],
                'lluvia' => $tm['lluvia'],
                'fecha' => $tm['fecha'],
                'prevision' => $tm['prevision'],
                'notice_id' => $tm['notice_id']
            ]);
            $time->save();
        }
    }
}
