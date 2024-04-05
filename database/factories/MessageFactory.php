<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id= DB::table('users')->pluck('id')->toArray();
        return [
            'from' => $id[array_rand($id, 1)],
            'to' => $id[array_rand($id, 1)],
            'content' => Str::random(50),
        ];
    }
}
