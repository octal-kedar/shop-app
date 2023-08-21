<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Http;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Tag;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = Subcategory::all();

        foreach ($subcategories as $subcategory) {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts'); // Replace with your API endpoint
            $data = $response->json();


            $count = 1;
            foreach ($data as $item) {



                if ($count == 5) {
                    break;
                }
                $product = $subcategory->products()->create([
                    'name' => $item['title'],
                    'description' => $item['body'],
                    'price' => rand(50, 500), // Example price range
                ]);
                $tags_name_arr = explode(' ', $item['title']);
                foreach ($tags_name_arr as $tagName) {                    
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $product->tags()->attach($tag);
                }
                $count++;
            }
        }
    }
}
