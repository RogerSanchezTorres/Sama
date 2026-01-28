<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'shop_enabled'],
            ['value' => '1']
        );
    }
}
