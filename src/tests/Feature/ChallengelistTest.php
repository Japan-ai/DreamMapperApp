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
     * 各テストメソッドの実行前に呼ばれるsetUp メソッドでシーダーを実行
     */
    public function setUp()
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成
        $this->seed('FoldersTableSeeder');
    }

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
}
