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
        Schema::create('=challengelist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);//追加
            $table->integer('status')->default(1);//追加
            $table->integer('delete')->default(1);//追加
            $table->date('due_date');//追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('=challengelist');
    }
}
