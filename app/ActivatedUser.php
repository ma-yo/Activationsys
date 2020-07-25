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
}
