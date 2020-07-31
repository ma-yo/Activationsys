<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 認証ユーザー管理テーブルを初回
 */
class CreateActivatedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activated_users', function (Blueprint $table) {
            //シリアルID
            $table->string('serialid');
            //アプリケーションID
            $table->string('appid');
            //登録者名
            $table->string('name');
            //登録EMAIL
            $table->string('email')->nullable();
            //端末固有情報
            $table->string('deviceid')->nullable();
            //削除フラグ
            $table->string('ban')->nullable();
            //デバイス更新回数
            $table->integer('devicechangecount')->default(0);
            //ライセンス番号
            $table->string('licenseid')->nullable();
            $table->timestamps();
            //インデックス
            $table->primary(['serialid'],'activated_users_pkey');
            //検索インデックス
            $table->index(['licenseid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activated_users');
    }
}
