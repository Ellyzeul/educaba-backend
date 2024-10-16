<?php

namespace Database\Seeders;

use App\Models\ProgramSetStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSetStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramSetStatus::insert([
            'id' => Str::repeat('0', 26),
            'name' => 'trainment',
        ]);
    }
}
