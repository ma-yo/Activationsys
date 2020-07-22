<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivatedUser;
use App\Commons\MessageUtil;


class DelSerialController extends Controller
{
    public function index (Request $request)
    {
        $request->session()->regenerateToken();
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $content = $request->input('content');
        switch($content){
            case "delserial":
                return $this->delserial($request);
            case "menu":
                return view('menu/index', $this->response);
            case "searchserial":
                return $this->searchserial($request);
        }
        
        //処理が存在しない場合
        return $this->getNoPageFound($request);
    }
    //シリアルを削除する
    private function delserial(Request $request){
        
        $delserial = $request->input('delserialid');
        ActivatedUser::where('serialid', $delserial)->update(['ban' => '1']);
        $activatedUsers = ActivatedUser::whereNull('ban')->take(100)->orderBy('updated_at','asc')->orderBy('created_at','asc')->get();
        $this->response['activeUsers'] = $activatedUsers;
        $this->response['message'] = MessageUtil::MSG_INF_0003;
        $this->response['messageType'] = MessageUtil::TYPE_INFO;

        return view('delserial/index', $this->response);
    }
    //シリアルを検索する
    private function searchserial(Request $request){

        $word = $request->input('searchword');
        $activatedUsers = null;
        if(empty($word)){
            $activatedUsers = ActivatedUser::whereNull('ban')->take(100)->orderBy('updated_at','asc')->orderBy('created_at','asc')->get();
        }else{

            $activatedUsers =  ActivatedUser::where(function($query) use ($word){
                $query->orWhere('name', 'LIKE', "%$word%")
                      ->orWhere('email', 'LIKE', "%$word%");
            })->whereNull('ban')->take(100)->orderBy('updated_at','asc')->orderBy('created_at','asc')->get();
        }
        $this->response['activeUsers'] = $activatedUsers;
        return view('delserial/index', $this->response);
    }
}
