<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Commons\MessageUtil;
use Illuminate\Support\Facades\Validator;
/**
 * ログイン認証コントローラー
 */
class LoginController extends Controller
{

    /**
     * ログイン画面を表示する
     *
     * @param Request $request
     * @return void
     */
    public function index (Request $request)
    {
        
        //Sessionをクリアする
        $this->clearSession($request);
        //csrf対策
        $request->session()->regenerateToken();

        return view('login/index', $this->response);

    }

    /**
     * ログイン認証を実行する
     *
     * @param Request $request
     * @return void
     */
    public function login (Request $request)
    {
        
        //Sessionをクリアする
        $this->clearSession($request);
        //csrf対策
        $request->session()->regenerateToken();

        $username = $request->input('login-username');
        $password = $request->input('login-password');
        $validator = Validator::make($request->all(), [
            'login-username'=>'required',
            'login-password'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //ユーザーテーブルを検索する
        $user = User::where('name', $username)
        ->where('password', $password)
        ->first();

        if($user != null){
            //ログイン成功したのでメニュー画面へ遷移
            $request->session()->put('username', $username);

            $this->response['commons']['message'] = MessageUtil::MSG_INF_0001;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_INFO;
            $this->response['commons']['username'] = $user->name;
            
            return view('menu/index', $this->response);
        }else{

            $this->response['commons']['message'] = MessageUtil::MSG_ERR_0002;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_DANGER;
            //ログイン失敗したのでログイン画面に戻る
            return view('menu/index', $this->response);
        }

    }

    /**
     * ログアウトします
     *
     * @param Request $request
     * @return void
     */
    public function logout (Request $request)
    {
        //Sessionをクリアする
        $this->clearSession($request);
        //csrf対策
        $request->session()->regenerateToken();

        $this->response['commons']['message'] = MessageUtil::MSG_INF_0002;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_INFO;
        //ログイン画面に戻ります
        return view('login/index', $this->response);
    }
}
