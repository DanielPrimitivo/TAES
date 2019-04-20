<?php

use Illuminate\Database\Seeder;
use App\Weather;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("time.ini", true);
        foreach($info as $tm){
            $time = new Weather([
                'viento' => $tm['viento'],
                'dirviento' => $tm['dirviento'],
                'humedad' => $tm['humedad'],
                'temperatura' => $tm['temperatura'],
                'lluvia' => $tm['lluvia'],
                'fecha' => $tm['fecha'],
                'notice_id' => $tm['notice_id']
            ]);
            $time->save();
        }
    }
}
