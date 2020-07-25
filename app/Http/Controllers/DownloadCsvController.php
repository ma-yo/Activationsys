<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commons\CsvDownloader;
use App\ActivatedUser;
use App\User;
use Laracsv\Export;
use League\Csv\Reader;
/**
 * CSVダウンロードを行う
 */
class DownloadCsvController extends Controller
{
    /**
     * シリアルキーCSVを出力する
     *
     * @param Request $request
     * @return void
     */
    public function downloadseriallistcsv(Request $request){

        $activatedUsers = ActivatedUser::all();

        $csvExporter = new Export();

        $csvExporter->beforeEach(function ($user) {
            $user->created_at = $user->created_at->format('Y-m-d H:i:s');
            $user->updated_at = $user->updated_at->format('Y-m-d H:i:s');
            if($user->ban == 0){
                $user->ban = '';
            }
            if($user->ban == 1){
                $user->ban = '凍結';
            }
        });

        $csvExporter->build($activatedUsers, [
            'serialid' => 'シリアルキー',
            'name' => 'ユーザー名',
            'email' => 'メールアドレス',
            'deviceid' => 'デバイスID',
            'devicechangecount' => 'デバイスID登録回数',
            'ban' => '削除済','created_at' => '登録日時','updated_at' => '更新日時',
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(Reader::BOM_UTF8);

        $filename = 'serial-list.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=shift_jis')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
    /**
     * ユーザー一覧をダウンロードする
     *
     * @return void
     */
    public function downloaduserlistcsv(){

        $users = User::all();

        $csvExporter = new Export();

        $csvExporter->beforeEach(function ($user) {
            $user->created_at = $user->created_at->format('Y-m-d H:i:s');
            $user->updated_at = $user->updated_at->format('Y-m-d H:i:s');
            if($user->authority == 1){
                $user->authority = '管理者';
            }
            if($user->authority == 2){
                $user->authority = '一般ユーザー';
            }
            if($user->ban == 0){
                $user->ban = '';
            }
            if($user->ban == 1){
                $user->ban = '凍結';
            }
        });

        $csvExporter->build($users, [
            'name' => 'ユーザー名',
            'password' => 'パスワード',
            'authority' => '権限',
            'ban' => '削除済','created_at' => '登録日時','updated_at' => '更新日時',
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(Reader::BOM_UTF8);

        $filename = 'user-list.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=shift_jis')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
