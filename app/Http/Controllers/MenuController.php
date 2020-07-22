<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commons\MessageUtil;
use App\ActivatedUser;
use App\Commons\CSVDownloader;

class MenuController extends Controller
{

    public function index (Request $request)
    {

        $request->session()->regenerateToken();
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $menutype = $request->input('menu-type');
        switch($menutype){
            case "menu":
                return view('menu/index', $this->response);
            case "gen-serial":
                return view('genserial/index', $this->response);
            case "del-serial":
                return $this->delSerial($request);
            break;

        }
        
        //処理が存在しない場合
        return $this->getNoPageFound($request);
    }
    //シリアルを検索する
    private function delSerial(Request $request){
        $activatedUsers = ActivatedUser::whereNull('ban')->take(100)->orderBy('updated_at','asc')->orderBy('created_at','asc')->get();
        $this->response['activeUsers'] = $activatedUsers;
        return view('delserial/index', $this->response);
    }

}
