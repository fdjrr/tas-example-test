<?php

namespace Database\Seeders;

use App\Models\PerPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $per_pages = [
            ['item' => 25],
            ['item' => 50],
            ['item' => 100],
        ];

        PerPage::insert($per_pages);
    }
}
