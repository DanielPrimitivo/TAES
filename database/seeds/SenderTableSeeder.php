<?php

use Illuminate\Database\Seeder;
use App\Sender;
class SenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = parse_ini_file("sender.ini", true);
        foreach($info as $tm){
            $time = new Sender([
                'tlf' => $tm['tlf'],
                'categoria' => $tm['categoria']
            ]);
            $time->save();
        }
    }
}
