<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Commons\MessageUtil;
use App\Commons\PasswordUtil;
class CreateUserController extends Controller
{
    /**
     * 新規ユーザー作成画面
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
        $this->response['commons']['subtitle'] = ' -> メニュー -> 新規ユーザー作成';
        return view('createuser/index', $this->response);
    }

    
    /**
     * 新規ユーザー登録を行う
     *
     * @param Request $request
     * @return void
     */
    public function create (Request $request)
    {
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $username = $request->input('username');
        $authority = $request->input('authority');

        $validator = Validator::make($request->all(), [
            'username'=>'required|max:256'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        
        $user = User::where('name', $username)->first();
        if(isset($user)){
            $this->response['commons']['subtitle'] = ' -> メニュー -> 新規ユーザー作成';
            $this->response['commons']['message'] = MessageUtil::MSG_ERR_0006;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_DANGER;
            return view('createuser/index', $this->response);
        }

        $passUtil = new PasswordUtil;
        $password = $passUtil->generateStrongPassword();
        $savedUser = DB::transaction(function () use ( $username, $password, $authority) {
            $user = new User;
            $user->name = $username;
            $user->password = $password;
            $user->authority = $authority;
            $user->save();
            return $user;
        });

        $this->response['commons']['subtitle'] = ' -> メニュー -> 新規ユーザー登録完了';
        $this->response['commons']['message'] = MessageUtil::MSG_INF_0008;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_SUCCESS;
        $this->response['datas'] = ['savedUser' => $savedUser];
        return view('createuser/result', $this->response);
    }


}
