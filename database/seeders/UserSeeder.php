<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            //$sql = 'insert into users ( name, email,password, created_at, email_verified_at) values (?, ?, ?, ?, ?)';
            $name = Str::random(10);
            /* DB::insert($sql, [
                 $name ,
                 $name.'@@gmail.com',
                 Hash::make('dededede'),
                 \Carbon\Carbon::now(),
                 \Carbon\Carbon::now()
             ]);
            */
            DB::table('users')->insert([
                'name' => $name,
                'email' => $name.'@gmail.com',
                'password' => Hash::make('dededede'),
                'created_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
            ]);
        }
    }
}
