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
        // $this->call(UsersTableSeeder::class);
        /*
        factory(App\User::class, 5)->create();

        factory(App\Profile::class, 5)->create();
        factory(App\Tweet::class, 5)->create();
        factory(App\Reply::class, 5)->create();
*/
        DB::table('followers')->insert([
            'user_id' => 5,
            'follow_id' =>  App\User::inRandomOrder()->first()->id,
        ]);
    }
}
