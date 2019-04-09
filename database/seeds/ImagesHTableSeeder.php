<?php

use Illuminate\Database\Seeder;
use App\HImage;

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
            $imagen = new HImage([
                'fecha' => $img['fecha'],
                'url' => $img['url'],
                'hcoordinate_id' => $img['hcoordinate_id'],
                'hnotice_id' => $img['hnotice_id']
            ]);
            $imagen->save();
        }
    }
}
