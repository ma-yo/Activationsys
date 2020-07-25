<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivatedUser;
use App\Commons\MessageUtil;
use Illuminate\Support\Facades\DB;
use App\SettingInfo;

/**
 * シリアルキーを削除するクラス
 */
class DelSerialController extends Controller
{

    /**
     * シリアル削除画面
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

        $activatedUsers = ActivatedUser::whereNull('ban')->take($this->getMaxSearchRow())->orderBy('devicechangecount', 'desc')->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();

        $this->response['commons']['subtitle'] = ' -> メニュー -> シリアルキー削除';
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
        $this->response['datas'] = ['searchword' => ''];
        return view('delserial/index', $this->response);
    }
    /**
     * シリアルを削除する
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        //検索文字列
        $word = $request->input('searchword');
        $delserials = $request->input('del-select');

        DB::transaction(function() use($delserials){
            foreach($delserials as $delserial){
                //banを1に更新し削除フラグを設定
                ActivatedUser::where('serialid', $delserial)->update(['ban' => '1']);
            }
        });

        $activatedUsers = ActivatedUser::whereNull('ban')->take($this->getMaxSearchRow())->orderBy('devicechangecount', 'desc')->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        $this->response['commons']['subtitle'] = ' -> メニュー -> シリアルキー削除';
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
        $this->response['datas'] = ['searchword' => $word];
        $this->response['commons']['message'] = MessageUtil::MSG_INF_0003;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_INFO;

        return view('delserial/index', $this->response);
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
            $activatedUsers = ActivatedUser::whereNull('ban')->take($this->getMaxSearchRow())->orderBy('devicechangecount', 'desc')->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        }else{
            //名称とEMAILであいまい検索を行う
            $activatedUsers =  ActivatedUser::where(function($query) use ($word){
                $query->orWhere('name', 'LIKE', "%$word%")
                ->orWhere('email', 'LIKE', "%$word%")
                ->orWhere('serialid', 'LIKE', strtoupper("%$word%"));
            })->whereNull('ban')->take(100)->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        }
        $this->response['commons']['subtitle'] = ' -> メニュー -> シリアルキー削除';
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
        $this->response['datas'] = ['searchword' => $word];
        //データ件数をメッセージに出力する
        $count = count($activatedUsers);
        if($count > 0){
            $this->response['commons']['message'] = $count . MessageUtil::MSG_INF_0005;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_SUCCESS;
        }else{
            $this->response['commons']['message'] = MessageUtil::MSG_ERR_0005;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_WARNING;
        }
        return view('delserial/index', $this->response);
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
