<?php

use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(['name' => 'Tim Joosten', 'password' => bcrypt('root1995!'), 'email' => 'topairy@gmail.com']);
    }
}
