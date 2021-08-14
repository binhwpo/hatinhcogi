<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name'=>'Bài viết', 'slug'=>'bai-viet', 'description'=>'bai-viet', 'icon'=>'https://vnn-imgs-f.vgcloud.vn/2021/07/06/16/148241555-10158762144220967-6979834080053453299-n.jpg'],
            ['category_name'=>'Địa điểm', 'slug'=>'dia-diem', 'description'=>'bai-viet', 'icon'=>'https://vnn-imgs-f.vgcloud.vn/2021/07/06/16/148241555-10158762144220967-6979834080053453299-n.jpg'],
        ]);

        DB::table('group_user')->insert([
            ['group_name'=>'Super Admin', 'slug'=>'super-admin', 'created_at' => date("Y-m-d H:i:s")],
            ['group_name'=>'Admin', 'slug'=>'sub-admin', 'created_at' => date("Y-m-d H:i:s")],
            ['group_name'=>'Người dùng', 'slug'=>'normal-user', 'created_at' => date("Y-m-d H:i:s")],
        ]);

        DB::table('users')->insert([
            ['name'=>'Admin', 'email'=>'developermail369@gmail.com', 'username'=>'admin', 'password'=>'$2y$10$EXdJJlzJiD7k9Xfl3KAu9Oer7GEc4amUufH4wxxKwmc85Nz1w5V4m', 'group_id'=>'1', 'created_at' => date("Y-m-d H:i:s")],
        ]);

        DB::table('ftp')->insert([
            ['name'=>'FTP 1', 'host'=>'img.hatinhcogi.com', 'username'=>'admin_dev', 'password'=>'admin_dev', 'port'=>'21', 'storage'=> '100', 'user_id' => 1,'status' => 1, 'created_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
