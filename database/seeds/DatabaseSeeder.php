<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NoticeTableSeeder::class);
        //$this->call(NoticeHTableSeeder::class);
        $this->call(CoordinatesTableSeeder::class);
        //$this->call(CoordinateHTableSeeder::class);
        $this->call(TimeTableSeeder::class);
        //$this->call(TimeHTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        //$this->call(ImagesHTableSeeder::class);
    }
}
