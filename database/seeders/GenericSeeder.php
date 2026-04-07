<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Generic;

class GenericSeeder extends Seeder
{
    public function run(): void
    {
        Generic::factory(20)->create();
    }
}