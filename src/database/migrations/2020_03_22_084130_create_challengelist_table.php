<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengelistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challengelist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('folder_id')->unsigned();//追加
            $table->string('title', 100);//追加
            $table->date('due_date');//追加
            $table->integer('status')->default(1);//追加,デフォルト値は「未着手」
            $table->timestamps();

            //外部キーの設定,challengelistテーブルのジャンルID列には、実際に存在するジャンルIDの値しか入れることができない
            $table->foreign('folder_id')->references('id')->on('folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challengelist');
    }
}
