<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call('UserTableSeeder');

        for($i = 0; $i < 11; $i++)
        {
            $factory->create(App\Coordinate::class);
        }

        Model::reguard();
    }
}
