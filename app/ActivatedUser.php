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
     * application テーブルを結合
     *
     * @return void
     */
    public function application()
    {
        return $this->hasOne('App\Application','appid','appid');
    }
}
