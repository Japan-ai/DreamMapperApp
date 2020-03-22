<?php

namespace Tests\Feature;

use App\Http\Requests\CreateChallengelist;//追加
use Carbon\Carbon;//追加
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;//追加

class ChallengelistTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行
    use RefreshDatabase;

    /**
     * 各テストメソッドの実行前に呼ばれるsetUpメソッドでシーダーを実行
     */
    public function setUp()
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成
        $this->seed('FoldersTableSeeder');
    }


    // 1 「チャレンジリスト新規作成時」の「期日選択」に関するバリデーションテスト
    /**
     * 期限日が日付ではない場合はエラー
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/challengelist/create', [
            'title' => 'Sample challengelist',
            'due_date' => 123, // エラーになる不正なデータ（数値）を指定
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。',
        ]);
    }
    /**
     * 期限日が過去日付の場合はエラー
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/challengelist/create', [
            'title' => 'Sample challengelist',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), // エラーになる不正なデータ（昨日の日付）を指定
        ]);
        //$response変数に対して、assertSessionHasErrorsメソッドでエラーメッセージがあることを確かめる
        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }



    // 2 「チャレンジリスト編集時」の「実行ステータス」に関するバリデーションテスト
    /**
    * 実行ステータスが定義された値ではない場合はバリデーションエラー
    * @test
    */
    public function status_should_be_within_defined_numbers()
    {
      $this->seed('ChallengeListTableSeeder');

      $response = $this->post('/folders/1/challengelist/1/edit', [
        'title' => 'Sample challengelist',
        'due_date' => Carbon::today()->format('Y/m/d'),
        'status' => 999,
      ]);

      //不正入力の場合はエラーメッセージを表示
      $response->assertSessionHasErrors([
          'status' => '実行ステータス には 未着手、作業中、完了 のいずれかを指定してください。',
      ]);
    }
}
