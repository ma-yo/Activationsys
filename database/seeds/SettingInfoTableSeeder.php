<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 設定情報保持テーブル
 */
class SettingInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      DB::table('setting_infos')->insert([
        [
            'settingid' => '0001',
            'value1' => '10',
            'description' => 'シリアル関連付け解除上限回数',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
          ],
          [
            'settingid' => '0002',
            'value1' => '300',
            'description' => '検索結果最大表示件数',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
          ],
      ]);
    }
}
