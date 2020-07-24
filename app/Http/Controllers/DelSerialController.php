<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivatedUser;
use App\Commons\MessageUtil;
use Illuminate\Support\Facades\DB;

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

        //上位100件のみ検索する
        $activatedUsers = ActivatedUser::whereNull('ban')->take(100)->orderBy('devicechangecount', 'desc')->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
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

        $delserials = $request->input('delselect');

        DB::transaction(function() use($delserials){
            foreach($delserials as $delserial){
                //banを1に更新し削除フラグを設定
                ActivatedUser::where('serialid', $delserial)->update(['ban' => '1']);
            }
        });

        //上位100件のみ検索する
        $activatedUsers = ActivatedUser::whereNull('ban')->take(100)->orderBy('devicechangecount', 'desc')->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
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

        //文字列が空の場合は、100件出力
        if(empty($word)){
            $activatedUsers = ActivatedUser::whereNull('ban')->take(100)->orderBy('devicechangecount', 'desc')->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        }else{
            //名称とEMAILであいまい検索を行う
            $activatedUsers =  ActivatedUser::where(function($query) use ($word){
                $query->orWhere('name', 'LIKE', "%$word%")
                      ->orWhere('email', 'LIKE', "%$word%");
            })->whereNull('ban')->take(100)->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        }
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
        return view('delserial/index', $this->response);
    }
}
