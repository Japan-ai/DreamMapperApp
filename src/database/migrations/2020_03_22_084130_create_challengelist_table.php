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
            $table->integer('status')->default(1);//追加
            $table->softDeletes();//追加
            $table->timestamps();

            $table->foreign('folder_id')->references('id')->on('folders');//外部キーの設定,challengelistテーブルのフォルダID列には実際に存在するフォルダIDの値しか入れることができない
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
