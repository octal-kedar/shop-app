<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts'); // Replace with your API endpoint
        $data = $response->json();

        $count = 1;
        foreach ($data as $item) {
            if ($count == 5) {
                break;
            }
            Category::create([
                'name' => $item['title'],
            ]);
            $count++;
        }
    }
}
