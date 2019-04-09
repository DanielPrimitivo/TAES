<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("imagen.ini", true);
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
