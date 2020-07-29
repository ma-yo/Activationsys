<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * 新規アプリケーション登録画面
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

        $applications = Application::all();
        $this->response['commons']['subtitle'] = ' -> メニュー -> アプリケーション登録';
        $this->response['datas'] = ['applications' => $applications];
        return view('application/index', $this->response);
    }
    /**
     * アプリケーションを更新
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $validator = Validator::make($request->all(), [
            'appname.*'=>'required|min:1|max:32',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $appIds = $request->input('appid');
        $names = $request->input('appname');

        $applications = DB::transaction(function() use($appIds, $names){
            $applications = [];
            foreach($appIds as $index => $appid){
                //banを1に更新し削除フラグを設定
                Application::where('appid', $appid)->update(['name' => $names[$index]]);
                $applications[] = Application::where('appid', $appid)->first();
            }
            return $applications;
        });

        $this->response['commons']['subtitle'] = ' -> メニュー -> アプリケーション登録成功';
        $this->response['datas'] = ['applications' => $applications];
        return view('application/result', $this->response);
    }
}
