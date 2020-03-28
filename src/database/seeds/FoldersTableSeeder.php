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
        //firstメソッドでユーザーを一行だけ取得して、そのIDをuser_idの値に指定
        $user = DB::table('users')->first();
        
        $titles = ['学び', '健康', '時間'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'user_id' => $user->id,
                //Carbonライブラリを使用して現在日時を入力
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
           ]);
       }
    }
}
