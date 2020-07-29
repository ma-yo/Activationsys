<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            [
                'appid' => '001',
                'name' => 'TopBuzzNewsUploader',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '002',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '003',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '004',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '005',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '006',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '007',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '008',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '009',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
              [
                'appid' => '010',
                'name' => 'NO SET',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
              ],
          ]);
    }
}
