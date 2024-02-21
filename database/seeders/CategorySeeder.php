<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danhmuc')->insert([
            ['category_name' => 'Thời trang nữ', 'parent_id' => '0', 'slug' => 'thoi-trang-nu'],
            ['category_name' => 'Thời trang nam', 'parent_id' => '0', 'slug' => 'thoi-trang-nam'],
            ['category_name' => 'Phụ kiện nữ', 'parent_id' => '0', 'slug' => 'phu-kien-nu'],
            ['category_name' => 'Phụ kiện nam', 'parent_id' => '0', 'slug' => 'phu-kien-nam'],
            ['category_name' => 'Áo nữ', 'parent_id' => '1', 'slug' => 'ao-nu'],
            ['category_name' => 'Quần nữ', 'parent_id' => '1', 'slug' => 'quan-nu'],
            ['category_name' => 'Đầm nữ', 'parent_id' => '1', 'slug' => 'dam-nu'],
            ['category_name' => 'Chân váy', 'parent_id' => '1', 'slug' => 'chan-vay'],
            ['category_name' => 'Áo nam', 'parent_id' => '2', 'slug' => 'ao-nam'],
            ['category_name' => 'Quần nam', 'parent_id' => '2', 'slug' => 'quan-nam'],
            ['category_name' => 'Giày nữ', 'parent_id' => '3', 'slug' => 'giay-nu'],
            ['category_name' => 'Túi xách nữ', 'parent_id' => '3', 'slug' => 'tui-xach-nu'],
            ['category_name' => 'Kính nữ', 'parent_id' => '3', 'slug' => 'kinh-nu'],
            ['category_name' => 'Giày nam', 'parent_id' => '4', 'slug' => 'giay-nam'],
        ]);
    }
}
