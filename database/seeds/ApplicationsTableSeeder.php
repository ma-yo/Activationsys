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
      $sqlAry = [];
      $sqlAry[] = [
        'appid' => '001',
        'name' => 'camel',
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
      ];
      for($i = 2; $i <=50; $i++){
        $id = str_pad($i, 3, 0, STR_PAD_LEFT);
        $sqlAry[] = [
          'appid' =>  $id,
          'name' => 'NO SET',
          'created_at' => new DateTime(),
          'updated_at' => new DateTime(),
        ];
      }
      DB::table('applications')->insert(
        $sqlAry
      );
    }
}
