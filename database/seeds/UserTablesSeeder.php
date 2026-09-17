<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
                'name'      => 'John Smith',
                'email'     => 'john_smith@gmail.com',
                'password'  => Hash::make('password'),
                'type'      => 'admin',
                'image_url' => url('storage/images/user/wolf.jpg')
        ]);
    }
}
