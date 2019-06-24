<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
