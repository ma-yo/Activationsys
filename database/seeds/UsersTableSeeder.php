<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //初回ログインユーザーを作成する
      DB::table('users')->insert([
          [
            'name' => 'WestHill',
            'password' => 'Nishiok@',
            'created_at' => new DateTime(),
          ],
        ]);
    }
}
