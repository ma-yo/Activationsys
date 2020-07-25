<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingInfo extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'setting_infos';

        /**
     * 有効なライセンス情報のみを代表100件取得する
     *
     * @return SettingInfo
     */
    public static function findById($settingid){
        return SettingInfo::where($settingid)->get();
    }
}
