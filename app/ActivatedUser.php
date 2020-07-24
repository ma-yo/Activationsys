<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * ライセンス認証ユーザー管理テーブル
 */
class ActivatedUser extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'activated_users';

    /**
     * 有効なライセンス情報のみを代表100件取得する
     *
     * @return ActivatedUser
     */
    public static function getValidUsers(){
        return ActivatedUser::whereNull('ban')->take(100)->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
    }
}
