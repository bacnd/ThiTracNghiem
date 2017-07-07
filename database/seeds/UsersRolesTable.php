<?php

use Illuminate\Database\Seeder;

class UsersRolesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_roles')->insert([

			'users_id' => 1,
			'roles_id' => 2

			]);

        DB::table('users_roles')->insert([

			'users_id' => 2,
			'roles_id' => 1

			]);
    }
}
