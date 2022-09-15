<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = Arr::random(['male', 'female']);

        return [
            'level'              =>  'user',
            'gender'             =>  $gender,
            'name'               =>  $this->getFirstName($gender) . ' ' . $this->getRandomLastName(),
            'mobile'             =>  $this->getUniqePhoneNumber(),
            'mobile_verified_at' =>  $this->faker->dateTimeBetween('-1 years', 'now', 'Asia/Tehran'),
            'weight'             =>  Arr::random([rand(50 , 110)  , null]),
            'height'             =>  Arr::random([rand(155 , 200) , null]),
            'birth_date'          => Arr::random([null , Carbon::now()->subYears(rand(15 , 50))]),
            'password'           =>  Arr::random([Hash::make('11111111') , null] ),  // 11111111
            'remember_token'     =>  Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function superAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'level'               => 'admin',
                'gender'              => 'male',
                'name'                => 'محمد کثیری',
                'mobile'              => '09109529484',
                'mobile_verified_at'  => now(),
                'last_login'          => now(),
                'password'            => Hash::make(11111111),
            ];
        });
    }
    /**
     * @param string $gender
     * @return string  First Name
     */
    private function getFirstName(string $gender = 'male'): string
    {
        return $gender == 'male'
            ? $this->getRandomMaleFirstName()
            : $this->getRandomFemaleFirstName();
    }


    private function getRandomMaleFirstName(): string
    {
        $maleNames = ['رضا', 'سجاد', 'شایان', 'دانیال', 'افشین', 'فربد', 'مصطفی', 'مهرداد', 'حامد', 'سپهر', 'محمد', 'علی', 'محمد رضا', 'حسین', 'فرید', 'امیر', 'علیرضا'];
        return Arr::random($maleNames);
    }

    /**
     * * @param null
     * @return string Female First Name
     */
    private function getRandomFemaleFirstName(): string
    {
        $femaleNames = ['یاسمین', 'مینا', 'درسا', 'فاطمه', 'مهدیه', 'الهه', 'سارا', 'نگار', 'نگین', 'راحله', 'سمانه', 'شیما', 'مهسا', 'هدیه', 'هلما', 'حمیرا'];
        return Arr::random($femaleNames);
    }

    /**
     * @param null
     * @return string LastName
     */
    private function getRandomLastName(): string
    {
        $lastNames = ['رضاپور', 'ابراهیمی', 'مرادی', 'میبدی', 'طاهری', 'موسوی', 'پناهی', 'آذری', 'قاضیان', 'شمسی', 'فلاح', 'محمدی', 'ترکاشوند', 'فتحیان', 'تبریزی', 'خراسانی', 'گودرزی', 'شریفی', 'شهبازی', 'حاتمی', 'نعمتی', 'کاظم زاده', 'علیپور', 'رضایی', 'کریمی', 'رحمانی', 'تاجیک', 'حیدری', 'خسروی', 'جهانی'];
        return Arr::random($lastNames);
    }

    /**
     * @return string
     */
    private function getUniqePhoneNumber(): string
    {
        $phone = generatePhone();
        $is_unique = User::query()->where('mobile', '=', $phone)->exists();
        return $is_unique == false
            ? $phone
            : $this->getUniqePhoneNumber();
    }
}
