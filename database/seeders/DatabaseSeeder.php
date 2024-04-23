<?php

namespace Database\Seeders;

use Domain\Category\Models\Category;
use Domain\Product\Models\Product;
use Domain\Tag\Models\Tag;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'admin',
            'phone_number' => '09390766284',
        ]);

        Auth::login($user);

        Product::factory(10)->create();

        User::factory(10)->create();

        Tag::factory(10)->create();

        Category::factory(10)->create();

        Auth::logout();
    }
}
