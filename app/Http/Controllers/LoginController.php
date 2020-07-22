<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Commons\MessageUtil;
class LoginController extends Controller
{
    public function index (Request $request)
    {
        
        //Sessionをクリアする
        $this->clearSession($request);
        $request->session()->regenerateToken();
        
        //処理切り分け用コンテンツ
        $content = $request->input('content');
        if(!isset($content)){
            return view('login/index', $this->response);
        }

        //処理切り分け
        switch($content){
            case "login":
                return $this->login($request);
            case "logout":
                return $this->logout($request);
        }

        //処理が存在しない場合
        return $this->getNoPageFound($request);

    }
    //ログインを試みます
    private function login (Request $request)
    {
        
        $username = $request->input('login-username');
        $password = $request->input('login-password');
        
        $user = User::where('name', $username)
        ->where('password', $password)
        ->first();


        if($user != null){

            $request->session()->put('username', $username);

            $this->response['message'] = MessageUtil::MSG_INF_0001;
            $this->response['messageType'] = MessageUtil::TYPE_INFO;
            $this->response['username'] = $user->name;

            return view('menu/index', $this->response);
        }else{

            $this->response['message'] = MessageUtil::MSG_ERR_0002;
            $this->response['messageType'] = MessageUtil::TYPE_DANGER;

            return view('login/index', $this->response);
        }
    }
    //ログアウトします
    public function logout (Request $request)
    {
        //Sessionをクリアする
        $this->clearSession($request);
        $request->session()->regenerateToken();

        $this->response['message'] = MessageUtil::MSG_INF_0002;
        $this->response['messageType'] = MessageUtil::TYPE_INFO;
        return view('login/index', $this->response);
    }
}
