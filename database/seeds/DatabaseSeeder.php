<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $data = [
            [
                'name' => 'Nguyễn Tiến Thành',
                'email' => 'nguyenthanh@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Hà Đông',
                'phone' => '0334736187',
                'role_id' => 0,
                'times' => 0,
                'status' => 0,
            ],
            [
                'name' => 'Bùi Quang Anh',
                'email' => 'quangsoi99@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Long Biên',
                'phone' => 0,
                'role_id' => 0,
                'times' => 0,
                'status' => 0,
            ],
        ];
        // $data = [
        //     [
        //         'name' => 'user.create',
        //         'description' => 'Thêm mới người dùng'
        //     ],
        //     [
        //         'name' => 'user.edit',
        //         'description' => 'Chỉnh sửa người dùng'
        //     ],
        //     [
        //         'name' => 'user.destroy',
        //         'description' => 'Xóa người dùng'
        //     ],
        // ];

        \App\Models\Permission::insert($data);
    }
}
