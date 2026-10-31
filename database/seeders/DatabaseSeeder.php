<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Demo data. All demo users use the password: password123 */
    public function run(): void
    {
        $lujain = User::create(['name' => 'Lujain', 'email' => 'lujain@example.com', 'password' => 'password123']);
        $sara = User::create(['name' => 'Sara', 'email' => 'sara@example.com', 'password' => 'password123']);

        $q1 = $lujain->quotes()->create(['content' => 'The best way to predict the future is to invent it.']);
        $q2 = $sara->quotes()->create(['content' => 'Simplicity is the soul of efficiency.']);

        $q1->likes()->attach([$sara->id]);
        $q2->likes()->attach([$lujain->id]);
    }
}
