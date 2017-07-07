<?php

use Illuminate\Database\Seeder;

class RolesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([

			'name' => 'member'

			]);

        DB::table('roles')->insert([

			'name' => 'admin'

			]);
    }
}
