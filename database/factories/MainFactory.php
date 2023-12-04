<?php

namespace Database\Factories;

use App\Models\Main;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;  //この行を追加
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Main>
 */
class MainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = Carbon::now();  //この行を追加
        return [
            'user_id'=>$this->faker->numberBetween(1,13),
            'main'=>$this->faker->realText(10),
            'created_at' => $now,  //この行を追加
            'updated_at' => $now, 
        ];
    }
}
