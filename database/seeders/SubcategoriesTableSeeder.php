<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts'); // Replace with your API endpoint
            $data = $response->json();

            $count = 1;
            foreach ($data as $item) {
                if ($count == 5) {
                    break;
                }
                $category->subcategories()->create([
                    'name' => $item['title'],
                ]);
                $count++;
            }
        }
    }
}
