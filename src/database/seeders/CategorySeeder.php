<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Горные прогулки'],
            ['name' => 'Пляжный отдых'],
            ['name' => 'Культурные туры'],
            ['name' => 'Экстремальные виды спорта'],
            ['name' => 'Круизы'],
            ['name' => 'Экотуризм'],
            ['name' => 'Семейный отдых'],
        ];

        // Вставка данных в таблицу categories
        DB::table('categories')->insert($categories);
    }
}
