<?php

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $cantidadUsers = 200;
        $cantidadCategories = 30;
        $cantidadProducts = 1000;
        $cantidadTransactions = 100;

        factory(User::class, $cantidadUsers)->create();
        factory(Category::class, $cantidadCategories)->create();
		factory(Product::class, $cantidadProducts)->create()->each(
			function ($product) {
				$categories = Category::all()->random(mt_rand(1,5))->pluck('id');

				$product->categories()->attach($categories);

			}
		);

        factory(Transaction::class, $cantidadTransactions)->create();
    }
}
