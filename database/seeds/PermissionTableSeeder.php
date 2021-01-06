<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'user.index',
                'description' => 'Hiển thị người dùng'
            ],
            [
                'name' => 'user.create',
                'description' => 'Thêm mới người dùng'
            ],
            [
                'name' => 'user.edit',
                'description' => 'Chỉnh sửa người dùng'
            ],
            [
                'name' => 'user.destroy',
                'description' => 'Xóa người dùng'
            ],
            [
                'name' => 'author.index',
                'description' => 'Hiển thị tác giả'
            ],
            [
                'name' => 'author.create',
                'description' => 'Thêm mới tác giả'
            ],
            [
                'name' => 'author.edit',
                'description' => 'Chỉnh sửa tác giả'
            ],
            [
                'name' => 'author.destroy',
                'description' => 'Xóa tác giả'
            ],
            [
                'name' => 'publisher.index',
                'description' => 'Hiển thị nhà xuất bản'
            ],
            [
                'name' => 'publisher.create',
                'description' => 'Thêm mới nhà xuất bản'
            ],
            [
                'name' => 'publisher.edit',
                'description' => 'Chỉnh sửa nhà xuất bản'
            ],
            [
                'name' => 'publisher.destroy',
                'description' => 'Xóa nhà xuất bản'
            ],
            [
                'name' => 'category.index',
                'description' => 'Hiển thị danh mục'
            ],
            [
                'name' => 'category.show',
                'description' => 'Xem chi tiết danh mục'
            ],
            [
                'name' => 'category.create',
                'description' => 'Thêm mới danh mục'
            ],
            [
                'name' => 'category.edit',
                'description' => 'Chỉnh sửa danh mục'
            ],
            [
                'name' => 'category.destroy',
                'description' => 'Xóa danh mục'
            ],
            [
                'name' => 'book.index',
                'description' => 'Hiển thị sách'
            ],
            [
                'name' => 'book.show',
                'description' => 'Xem chi tiết sách'
            ],
            [
                'name' => 'book.create',
                'description' => 'Thêm mới sách'
            ],
            [
                'name' => 'book.edit',
                'description' => 'Chỉnh sửa sách'
            ],
            [
                'name' => 'book.destroy',
                'description' => 'Xóa sách'
            ],
        ];

        Permission::insert($data);
    }
}
