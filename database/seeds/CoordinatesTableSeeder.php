<?php

use Illuminate\Database\Seeder;
use App\Coordinate;

class CoordinatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("coordinate.ini", true);
        foreach($info as $coord){
            $coordinate = new Coordinate([
                'x' => $coord['x'],
                'y' => $coord['y'],
                'notice_id' => $coord['notice_id']
            ]);
            $coordinate->save();
        }
    }
}
