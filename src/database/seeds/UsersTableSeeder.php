<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//追加
use Carbon\Carbon;//追加

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'dummy@email.com',
            //bcrypt関数で与えられた文字列の暗号化
            'password' => bcrypt('test1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
