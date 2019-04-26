<?php

use Illuminate\Database\Seeder;
use App\Himage;

class ImagesHTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("imageh.ini", true);
        foreach($info as $img){
            $imagen = new Himage([
                'fecha' => $img['fecha'],
                'url' => $img['url'],
                'lat' => $img['lat'],
                'long' => $img['long'],
                'direccion' => $img['direccion'],
                'sender_id' => $img['sender_id'],
                'hnotice_id' => $img['hnotice_id']
            ]);
            $imagen->save();
        }
    }
}
