<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //khiong có truncated mỗi lần seeder nó lại tạo mới dữ liệu nó là xóa trắng dữ liệu
        Schema::disableForeignKeyConstraints();
        //dùng truncate để còn chạy lại
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();

        Tag::factory(15)->create();
        //size có s, m ,l, xl, xxl
        foreach(['S', 'M', 'L', 'XL', 'XXL'] as $item){
            ProductSize::query()->create([
                'name' => $item,
            ]);
        }

        foreach(['#000000', '#FFFFFF', '#FF0000', '#00FF00', '#0000FF'] as $item){
            ProductColor::query()->create([
                'name' => $item,
            ]);
        }

        for($i = 0; $i < 1000; $i++){
            $name = fake()->text(100);
            Product::query()->create([
                'catalogues_id' => rand(2,7), 
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'img_thumbnail' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s002-sb001-1.webp',
                'price_regular' => 600000,
                'price_sale' => 499000,
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s002-sb001-1.webp',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s002-sb001-l-1-u.webp',
                ],
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i,
                    'tag_id' => rand(1, 8)
                ],
                [
                    'product_id' => $i,
                    'tag_id' => rand(9, 15)
                ]
            ]);
        }
//insert nhiều
        for ($productID = 1; $productID < 1001; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 6; $sizeID++) {
                for ($colorID = 1; $colorID < 6; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quality' => 100,
                        'img' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s002-sb001-l-1-u.webp',
                    ];
                }
            }

            DB::table('product_variants')->insert($data);
        }
        //ít câu truy vấn thì dùng create được chứ dùng nhiều là phải dùng insert nhiều
    }
}
