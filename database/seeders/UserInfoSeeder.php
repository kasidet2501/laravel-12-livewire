<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserInfo;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UserInfoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('th_TH'); // ใช้ภาษาไทย

        $titles = ['นาย', 'นาง', 'นางสาว'];

        for ($i = 0; $i < 20; $i++) {
            $birthdate = $faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d');
            $age = Carbon::parse($birthdate)->age;

            UserInfo::create([
                'title' => $faker->randomElement($titles),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'birthdate' => $birthdate,
                'age' => $age,
                'profile_image' => 'profile_images/QsAvu2xNYLmLDet24KT9Qp9qM0HVD7tdH1eZTUrC.jpg',
            ]);
        }
    }
}
