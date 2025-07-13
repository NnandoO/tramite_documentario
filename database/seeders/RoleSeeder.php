<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->upsert([
            ['id' => 1, 'name' => 'usuario'],
            ['id' => 4, 'name' => 'operador'],
            ['id' => 5, 'name' => 'product_owner'],
        ], ['id'], ['name']);
    }
}
