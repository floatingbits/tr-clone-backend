<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Board::class, 2)->create();
        factory(App\CardList::class, 7)->create();
        factory(App\Card::class, 40)->create();
    }
}
