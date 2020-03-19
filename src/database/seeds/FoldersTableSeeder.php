<?php
use Carbon\Carbon;

use Illuminate\Database\Seeder; //追加
use Illuminate\Support\Facades\DB; //追加
class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['学び', '健康', '時間'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
           ]);
       }
    }
}
