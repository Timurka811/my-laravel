<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@shop.test'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        $categories = ['Смартфоны', 'Ноутбуки', 'Наушники', 'Аксессуары'];

        foreach ($categories as $name) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );

            for ($i = 1; $i <= 6; $i++) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $name.' модель '.$i,
                    'slug' => Str::slug($name.' model '.$i).'-'.Str::random(4),
                    'description' => 'Описание товара '.$name.' модель '.$i,
                    'price' => rand(5000, 250000),
                    'stock' => rand(0, 30),
                    'is_active' => true,
                ]);
            }
        }
    }
}
