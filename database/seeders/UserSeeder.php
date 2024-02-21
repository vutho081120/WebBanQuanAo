<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nguoidung')->insert([
            ['phone' => '0345444322',
            'password' => Hash::make('admin'),
            'gender' => 'Nam',
            'email' => 'admin@gmail.com',
            'birthday' => Carbon::parse('2000-11-08'),
            'user_name' => 'Admin',
            'tinh_id'=>'1',
            'huyen_id'=>'21',
            'phuong_id'=>'610',
            'address' => '7, ngõ 397, Phạm Văn Đồng',
            'role' => '0'],
            ['phone' => '0123456789',
            'password' => Hash::make('123123'),
            'gender' => 'Nam',
            'email' => 'tho@gmail.com',
            'birthday' => Carbon::parse('2000-11-08'),
            'user_name' => 'Thọ',
            'tinh_id'=>'22',
            'huyen_id'=>'205',
            'phuong_id'=>'7126',
            'address' => '278, Nguyễn Bình, Mễ Xá 2',
            'role' => '1'],
            ['phone' => '0123456788',
            'password' => Hash::make('123123'),
            'gender' => 'Nữ',
            'email' => 'phuong@gmail.com',
            'birthday' => Carbon::parse('2000-02-22'),
            'user_name' => 'Phương',
            'tinh_id'=>'36',
            'huyen_id'=>'356',
            'phuong_id'=>'13693',
            'address' => '14, Giải Phóng',
            'role' => '1'],
        ]);
    }
}
