<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

			'name' => 'Dương Tuấn',
			'email' => 'admin@local.com',
            'password' => bcrypt('123123'),
			'gender' => 'm',
            'avatar' => 'avatar.jpg'

			]);

        DB::table('users')->insert([

            'name' => 'Demo',
            'email' => 'demo@local.com',
            'password' => bcrypt('123123'),
            'gender' => 'f',
            'avatar' => 'avatar.jpg'

            ]);
    }
}
