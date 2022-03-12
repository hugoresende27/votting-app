<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityLink>
 */
class CommunityLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'user_id'=>User::factory(),
            'channel_id'=>rand(1,3),
            'title'=>$this->faker->sentence(),
            'link'=>$this->faker->url(),
            'approved'=>0
        ];
    }
}
