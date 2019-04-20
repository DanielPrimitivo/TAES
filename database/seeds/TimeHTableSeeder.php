<?php

use Illuminate\Database\Seeder;
use App\Hweather;

class TimeHTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("timeh.ini", true);
        foreach($info as $tm){
            $time = new Hweather([
                'viento' => $tm['viento'],
                'dirviento' => $tm['dirviento'],
                'humedad' => $tm['humedad'],
                'temperatura' => $tm['temperatura'],
                'lluvia' => $tm['lluvia'],
                'fecha' => $tm['fecha'],
                'hnotice_id' => $tm['hnotice_id']
            ]);
            $time->save();
        }
    }
}
