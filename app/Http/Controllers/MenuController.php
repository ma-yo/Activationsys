<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commons\MessageUtil;
use App\ActivatedUser;
use App\Commons\CSVDownloader;

/**
 * メニューコントローラー
 */
class MenuController extends Controller
{
    /**
     * メニュー画面を表示する
     *
     * @param Request $request
     * @return void
     */
    public function index (Request $request)
    {
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }   
        $this->response['commons']['subtitle'] = ' -> メニュー';
        return view('menu/index', $this->response);
    }
}
