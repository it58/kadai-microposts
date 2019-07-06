<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicropostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microposts', function (Blueprint $table) {
            $table->increments('id');
            // 負の数が保存されることを防ぐ　
            // テーブルのカラムにつけることで検索速度を高める
            $table->integer('user_id')->unsigned()->index();
            $table->string('content');
            $table->timestamps();
            
            //外部キー制約
            // 制約される　user_id
            // 制約先　usersテーブルのidカラム
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('microposts');
    }
}
