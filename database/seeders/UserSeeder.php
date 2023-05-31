<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =[
            [
                'id' => 1001,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 1
            ],
            [
                'id' => 2001,
                'name' => 'Amin',
                'email' => 'amin@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
        ];
        foreach ($user as $user) {
            $users = new User();

            $users->id = $user['id'];
            $users->name = $user['name'];
            $users->email = $user['email'];
            $users->password = $user['password'];
            $users->is_admin = $user['is_admin'];

            $users->save();
        }
        
        // User::create([
        //     'id' => 1001,
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'is_admin' => 1
        // ],
        // [
        //     'id' => 2001,
        //     'name' => 'Amin',
        //     'email' => 'amin@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'is_admin' => 0
        // ]);
    }
}
