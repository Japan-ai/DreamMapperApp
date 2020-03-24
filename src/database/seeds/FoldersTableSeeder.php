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
    //学び, 健康, 時間の３つのフォルダを作成。
    public function run()
    {
        $titles = ['学び', '健康', '時間'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                //Carbonライブラリを使用して現在日時を入力
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
           ]);
       }
    }
}
