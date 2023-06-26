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
            [
                'id' => 2002,
                'name' => 'Andrian',
                'email' => 'andrian@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2003,
                'name' => 'Akbar',
                'email' => 'akbar@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2004,
                'name' => 'Prima',
                'email' => 'prima@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2005,
                'name' => 'Aqim',
                'email' => 'aqim@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2006,
                'name' => 'Chosyi',
                'email' => 'chosyi@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2007,
                'name' => 'Abdul',
                'email' => 'abdul@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2008,
                'name' => 'Slamet',
                'email' => 'slamet@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2009,
                'name' => 'Adit',
                'email' => 'adit@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0
            ],
            [
                'id' => 2010,
                'name' => 'Hadi',
                'email' => 'hadi@gmail.com',
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
