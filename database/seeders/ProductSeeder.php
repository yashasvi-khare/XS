<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $raw = [
            "name" => "Foundation Beshop",
            "oldPrice" =>  "249.95",
            "price" => "200.95",
            "isSale" => true,
            "isNew" => false,
            "image" => "/assets/img/product-img2.jpg",
            "category_id" => 1,
            "isStocked" => true,
            "productNumber" => "IN1203",
            "imageGallery" => json_encode([
                "/assets/img/product-img2.jpg",
                "/assets/img/product-img6.jpg",
                "/assets/img/product-img7.jpg",
                "/assets/img/product-img8.jpg",
                "/assets/img/product-img9.jpg"
              ]),
            "colors" => json_encode([
                "#FCEDEA",
                "#FEE1DB",
                "#FFD9D1",
                "#FDC5B9",
                "#FDB7A8",
                "#FFA08A"
            ]),
            "content" => "Universal foundation masks skin imperfections and gives it a matte finish, remaining completely invisible on the face. The foundation is suitable for any skin type. Thanks to a unique combination of pigments, the foundation adapts perfectly to even the smallest features of skin tone, creating an even and natural tone",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi beatae provident ipsum omnis dolor sapiente maiores reiciendis exercitationem earum deleniti, reprehenderit iste ipsa saepe. Consectetur non et excepturi molestias esse?",
            "review_id" => 1  
        ];
        $review = [
            "user_id" => 1,
            "rating" => 4,
            "content" => "I am grateful to the employees of BeShop for the quality products that I have been using for more than a year, try to work at this level in the future. Thank you"
        ];
        Review::create($review);
        Product::create($raw);
    }
}
