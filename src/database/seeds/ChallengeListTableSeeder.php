<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChallengeListTableSeeder extends Seeder
{
    //ジャンルID１に、３つのチャレンジリストを入力 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 3) as $num) {
            DB::table('challengelist')->insert([
                'folder_id' => 1,
                'title' => "テスト {$num}",
                'status' => $num,
                //現在時間から1.2.3日加算した日付を指定
                'due_date' => Carbon::now()->addDay($num),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
