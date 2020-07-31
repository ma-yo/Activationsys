<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseInfo extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'license_infos';

        /**
     * application テーブルを結合
     *
     * @return void
     */
    public function activateduser()
    {
        return $this->hasMany('App\ActivatedUser','licenseid','licenseid');
    }
}
