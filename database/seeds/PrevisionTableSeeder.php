<?php

use Illuminate\Database\Seeder;
use App\Prevision;

class PrevisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("prevision.ini", true);
        foreach($info as $pv){
            $prevision = new Prevision([
                'rango_hora' => $pv['rango_hora'],
                'viento' => $pv['viento'],
                'dirviento' => $pv['dirviento'],
                'humedad' => $pv['humedad'],
                'temperatura' => $pv['temperatura'],
                'lluvia' => $pv['lluvia'],
                'fecha' => $pv['fecha'],
                'weather_id' => $pv['weather_id']
            ]);
            $prevision->save();
        }
    }
}
