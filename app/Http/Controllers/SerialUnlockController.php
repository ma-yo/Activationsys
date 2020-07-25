<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivatedUser;
use App\Commons\MessageUtil;
use Illuminate\Support\Facades\DB;
use App\SettingInfo;

class SerialUnlockController extends Controller
{
    /**
     * シリアル凍結解除画面
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

        $activatedUsers =  $this->getLockUserAll();

        $this->response['commons']['subtitle'] = ' -> メニュー -> シリアルキー凍結解除';
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
        return view('serialunlock/index', $this->response);
    }
    /**
     * シリアル凍結を解除する
     *
     * @param Request $request
     * @return void
     */
    public function unlock(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $unlockserials = $request->input('unlock-select');

        DB::transaction(function() use($unlockserials){
            foreach($unlockserials as $unlockserial){
                //banを解除、デバイス更新回数も1に設定
                ActivatedUser::where('serialid', $unlockserial)->update(['ban' => null, 'devicechangecount' => 1]);
            }
        });

        $activatedUsers =  $this->getLockUserAll();
        
        $this->response['commons']['subtitle'] = ' -> メニュー -> シリアルキー凍結解除';
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
        $this->response['commons']['message'] = MessageUtil::MSG_INF_0007;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_INFO;

        return view('serialunlock/index', $this->response);
    }
    /**
     * シリアルを検索する
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request){

        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        //検索文字列
        $word = $request->input('searchword');
        $activatedUsers = null;

        if(empty($word)){
            //文字列がからの場合は全件表示
            $activatedUsers =  $this->getLockUserAll();
        }else{
            $serialreset = $this->getMaxSearchRow();
            //名称とEMAIL,シリアルキーであいまい検索を行う
            $activatedUsers =  ActivatedUser::where(function($query) use ($serialreset){
                $query->orWhere('ban', '1')
                ->orWhere('devicechangecount', '>', $serialreset);
            })->where(function($query) use ($word){
                $query->orWhere('name', 'LIKE', "%$word%")
                ->orWhere('email', 'LIKE', "%$word%")
                ->orWhere('serialid', 'LIKE', strtoupper("%$word%"));
            })->take($this->getMaxSearchRow())->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        }
        $this->response['commons']['subtitle'] = ' -> メニュー -> シリアルキー凍結解除';
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
        //データ件数をメッセージに出力する
        $count = count($activatedUsers);
        if($count > 0){
            $this->response['commons']['message'] = $count . MessageUtil::MSG_INF_0005;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_SUCCESS;
        }else{
            $this->response['commons']['message'] = MessageUtil::MSG_ERR_0005;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_WARNING;
        }
        return view('serialunlock/index', $this->response);
    }

    /**
     * シリアル凍結されているデータを取得する
     *
     * @return void
     */
    private function getLockUserAll(){
        $serialreset = $this->getMaxSearchRow();
        $activatedUsers =  ActivatedUser::where(function($query) use ($serialreset){
            $query->orWhere('ban', '1')
            ->orWhere('devicechangecount', '>', $serialreset);
        })->take($this->getMaxSearchRow())->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        return $activatedUsers;
    }
    /**
     * 最大表示行数を取得する
     *
     * @return void
     */
    private function getMaxSearchRow(){
        $maxsearchrow = SettingInfo::where('settingid', '0002')->first();
        return $maxsearchrow->value1;
    }
}
