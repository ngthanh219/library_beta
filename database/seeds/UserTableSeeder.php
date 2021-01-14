<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserTableSeeder extends Seeder
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
                'name' => 'Nguyễn Tiến Thành',
                'email' => 'nguyenthanh@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Hà Đông',
                'phone' => '0334736187',
                'role_id' => 3,
                'times' => 0,
                'status' => 3,
            ],
            [
                'name' => 'Bùi Quang Anh',
                'email' => 'quangsoi99@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Long Biên',
                'phone' => 0,
                'role_id' => 3,
                'times' => 0,
                'status' => 3,
            ],
            [
                'name' => 'client',
                'email' => 'client@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Long Biên',
                'phone' => 0,
                'role_id' => 1,
                'times' => 0,
                'status' => 0,
            ]
        ];

        User::insert($data);
    }
}
