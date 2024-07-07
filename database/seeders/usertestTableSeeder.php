<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class usertestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $testusers = [
            ['id' => Str::uuid()],
            ['id' => Str::uuid()],
            ['id' => Str::uuid()],
            ['id' => Str::uuid()],
            ['id' => Str::uuid()],
            ['id' => Str::uuid()],
            ['id' => Str::uuid()],
        ];
        foreach ($testusers as $testuser) {
        DB::table('testuser')->insert($testuser);
    }
}
}