<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commons\CsvDownloader;
use App\ActivatedUser;

//CSVダウンロードクラス
class DownloadCsvController extends Controller
{
    //Serial一覧をCSV出力する
    public function index(Request $request){
        $csv = new CSVDownloader;
        $activatedUsers = ActivatedUser::all();
        $activatedUsers = $activatedUsers->toArray();
        $header = ['serialid','name','email','biosid','ban','created_at','updated_at'];
        return $csv->download($activatedUsers, $header, 'serial-list.csv');
    }
}
