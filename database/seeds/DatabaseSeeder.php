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
        $this->call(EstateSeed::class);
        $this->call(CitySeed::class);
        $this->call(UserSeed::class);
    }
}
