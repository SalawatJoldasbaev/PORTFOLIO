<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'JAKSIBAY',
            'last_name' => 'KHAKIMOV',
            'phone' => '+998913941113',
            'address' => 'Shimbay go',
            'birth_date' => '1998-01-01',
            'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo rerum cupiditate magni adipisci vero enim placeat perspiciatis eius laudantium eligendi, doloribus exercitationem sit ratione consectetur cum numquam. Laudantium nisi excepturi omnis sit reprehenderit.',
            'job' => 'Android Developer',
            'email' => 'jaksibay@gmail.com',
            'password' => Hash::make('jaksibay1113')
        ]);
    }
}
