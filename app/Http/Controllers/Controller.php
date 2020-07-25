<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Commons\MessageUtil;
use Illuminate\Http\Request;

/**
 * 全てのControllerクラスに継承される親Controllerクラス
 * 共通変数及び、共通関数等を定義する
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * レスポンス用の連想配列
     * commonsには全画面共通情報を格納する
     * datasは自由にデータを保持することが可能
     *
     * @var array
     */
    public $response = ['commons' => ['systemdate' => null, 'subtitle' => null, 'username' => null, 'authority' => null, 'message' => null, 'messageType' => null], 'datas' => null];
    /**
     * Construct
     */
    public function __construct()
    {
        $this->response['commons']['systemdate'] = date('Ymd-Hi');
    }
    /**
     * ログイン状態のチェック
     * セッション情報が残っていればログイン中と判断する
     *
     * @param Request $request
     * @return void
     */
    public function checkLogin(Request $request){
        if (!$request->session()->exists('username')) {
            $this->response['commons']['message'] = MessageUtil::MSG_ERR_0003;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_DANGER;
            return false;
        }else{
            $this->response['commons']['username'] = $request->session()->get('username');
            $this->response['commons']['authority'] = $request->session()->get('authority');
        }
        return true;
    }

    /**
     * ページが見つからなかった場合ログイン画面に戻す
     *
     * @param Request $request
     * @return void
     */
    public function getNoPageFound(Request $request){
        $this->response['commons']['message'] = MessageUtil::MSG_ERR_0001;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_DANGER;
        $this->response['commons']['username'] = null;
        $this->response['commons']['authority'] = null;
        return view('login/index', $this->response);
    }
    /**
     * セッション情報をクリアする
     *
     * @param Request $request
     * @return void
     */
    public function clearSession(Request $request){
        //セッションが存在していたら破棄する
        if ($request->session()->exists('username')) {
            $request->session()->flush();
        }
    }
}
