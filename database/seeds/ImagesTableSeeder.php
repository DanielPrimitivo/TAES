<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("image.ini", true);
        foreach($info as $img){
            $imagen = new Image([
                'fecha' => $img['fecha'],
                'url' => $img['url'],
                'lat' => $img['lat'],
                'long' => $img['long'],
                'direccion' => $img['direccion'],
                'user_id' => $img['user_id'],
                'notice_id' => $img['notice_id']
            ]);
            $imagen->save();
        }
    }
}
