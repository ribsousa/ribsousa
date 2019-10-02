<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Ronaldo Ribeiro de Sousa',
            'email'     =>  'ribbsousa@gmail.com',
            'password'  => bcrypt('12345678'),
        ]);
    }
}
