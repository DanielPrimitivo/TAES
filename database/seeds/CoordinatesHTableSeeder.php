<?php

use Illuminate\Database\Seeder;

class CoordinatesHTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("coordinateh.ini", true);
        foreach($info as $coord){
            $coordinate = new HCoordinate([
                'x' => $coord['x'],
                'y' => $coord['y'],
                'notice' => $coord['notice']
            ]);
            $coordinate->save();
        }
    }
}
