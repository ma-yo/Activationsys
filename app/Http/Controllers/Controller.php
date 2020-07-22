<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Commons\MessageUtil;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //ﾚｽﾎﾟﾝｽ用の連想配列
    public $response = ['username' => null, 'message' => null, 'messageType' => null];

    //ログイン状態のチェック
    public function checkLogin(Request $request){
        if (!$request->session()->exists('username')) {
            $this->response['message'] = MessageUtil::MSG_ERR_0003;
            $this->response['messageType'] = MessageUtil::TYPE_DANGER;
            return false;
        }else{
            $this->response['username'] = $request->session()->get('username');
        }
        return true;
    }

    //ページが見つからなかった場合ログイン画面に戻す
    public function getNoPageFound(Request $request){
        $this->response['message'] = MessageUtil::MSG_ERR_0001;
        $this->response['messageType'] = MessageUtil::TYPE_DANGER;
        $this->response['username'] = null;
        return view('login/index', $this->response);
    }
    //セッション情報をクリアする
    public function clearSession(Request $request){
        if ($request->session()->exists('username')) {
            $request->session()->flush();
        }
    }
}
