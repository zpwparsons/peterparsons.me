<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tool;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Article::withoutSyncingToSearch(static function () {
            Article::factory(20)->create();
        });

        Tool::factory(5)->create();
    }
}
