<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('categories')->insert([

			'name' => 'Toán'

			]);

		DB::table('categories')->insert([

			'name' => 'Vật lý'

			]);

		DB::table('categories')->insert([

			'name' => 'Hoá học'

			]);

		DB::table('categories')->insert([

			'name' => 'Sinh học'

			]);
    }
}
