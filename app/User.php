<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * ログインユーザー管理テーブル
 */
class User extends Model
{
    /**
     * ログインユーザー用テーブル
     *
     * @var string
     */
    protected $table = 'users';
}
