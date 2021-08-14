<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['permission_name' => 'Xem thống kê', 'slug'=> 'view-dashboard', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách hỗ trợ', 'slug'=> 'view-support', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Trả lời hỗ trợ', 'slug'=> 'ref-support', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa hỗ trợ', 'slug'=> 'delete-support', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách danh mục', 'slug'=> 'view-category', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm danh mục', 'slug'=> 'add-category', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa danh mục', 'slug'=> 'edit-category', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa danh mục', 'slug'=> 'delete-category', 'created_at' => date("Y-m-d H:i:s")],
            
            ['permission_name' => 'Xem danh sách bài viết', 'slug'=> 'view-post', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm bài viết', 'slug'=> 'add-post', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa bài viết', 'slug'=> 'edit-post', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa bài viết', 'slug'=> 'delete-post', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách địa điểm', 'slug'=> 'view-place', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm địa điểm', 'slug'=> 'add-place', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa địa điểm', 'slug'=> 'edit-place', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa địa điểm', 'slug'=> 'delete-place', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách nhóm tài khoản', 'slug'=> 'view-group', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm nhóm tài khoản', 'slug'=> 'add-group', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa nhóm tài khoản', 'slug'=> 'edit-group', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa nhóm tài khoản', 'slug'=> 'delete-group', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách tài khoản', 'slug'=> 'view-user', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm tài khoản', 'slug'=> 'add-user', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa tài khoản', 'slug'=> 'edit-user', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa tài khoản', 'slug'=> 'delete-user', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách tài khoản ftp', 'slug'=> 'view-userftp', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm tài khoản ftp', 'slug'=> 'add-userftp', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa tài khoản ftp', 'slug'=> 'edit-userftp', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa tài khoản ftp', 'slug'=> 'delete-userftp', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách đường dẫn', 'slug'=> 'view-slug', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa đường dẫn', 'slug'=> 'delete-slug', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách quyền', 'slug'=> 'view-permission', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm quyền', 'slug'=> 'add-permission', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa quyền', 'slug'=> 'edit-permission', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa quyền', 'slug'=> 'delete-permission', 'created_at' => date("Y-m-d H:i:s")],

            ['permission_name' => 'Xem danh sách bình luận', 'slug'=> 'view-comment', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Thêm bình luận', 'slug'=> 'add-comment', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Sửa bình luận', 'slug'=> 'edit-comment', 'created_at' => date("Y-m-d H:i:s")],
            ['permission_name' => 'Xóa bình luận', 'slug'=> 'delete-comment', 'created_at' => date("Y-m-d H:i:s")],

            // ['permission_name' => 'Xem danh sách ', 'slug'=> 'view-', 'created_at' => date("Y-m-d H:i:s")],
            // ['permission_name' => 'Thêm ', 'slug'=> 'add-', 'created_at' => date("Y-m-d H:i:s")],
            // ['permission_name' => 'Sửa ', 'slug'=> 'edit-', 'created_at' => date("Y-m-d H:i:s")],
            // ['permission_name' => 'Xóa ', 'slug'=> 'delete-', 'created_at' => date("Y-m-d H:i:s")],
        ]);

        for ($i = 1; $i <= 38; $i++) { 
            DB::table('group_has_permissions')->insert([
                ['group_id' => 1, 'permission_id'=> $i],
            ]);
        }

        for ($i = 1; $i <= 38; $i++) { 
            DB::table('user_has_permissions')->insert([
                ['user_id' => 1, 'permission_id'=> $i],
            ]);
        }
    }
}
