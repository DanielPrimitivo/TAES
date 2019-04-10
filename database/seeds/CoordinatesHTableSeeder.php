<?php

use Illuminate\Database\Seeder;
use App\HCoordinate;

class CoordinatesHTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_coordinates')->delete();

        $info = parse_ini_file("coordinateh.ini", true);
        foreach($info as $coord){
            $coordinate = new HCoordinate([
                'x' => $coord['x'],
                'y' => $coord['y'],
                'hnotice_id' => $coord['hnotice_id']
            ]);
            $coordinate->save();
        }
    }
}
