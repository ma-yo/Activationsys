<?php

namespace App\Http\Controllers;

use App\Rules\PasswordComplexity;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Commons\ConstValue;
use App\Commons\MessageUtil;
use App\Commons\PasswordUtil;

/**
 * ユーザー情報修正
 */
class EditUserController extends Controller
{

    /**
     * ユーザー情報修正画面
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

        $username = $request->session()->get('username');
        $authority = $request->session()->get('authority');
        $user = User::where('name', $username)->first();

        $passwordUtil = new PasswordUtil;
        $genpassword = $passwordUtil->generateStrongPassword();
        $this->response['commons']['subtitle'] = ' -> メニュー -> ユーザー情報編集';
        $this->response['datas'] = ['user' => $user, 'genpassword' => $genpassword];
        if($authority == "1"){
            $allusers = User::orderBy('created_at','asc')->get();
            $this->response['datas'] = array_merge($this->response['datas'], ['allusers' => $allusers]);
        }
        return view('edituser/index', $this->response);
    }
    /**
     * 編集ユーザーを変更する
     *
     * @param Request $request
     * @return void
     */
    public function changeuser(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $authority = $request->session()->get('authority');

        $changeuser = $request->input('userlist');
        $user = User::where('name', $changeuser)->first();

        $passwordUtil = new PasswordUtil;

        $this->response['commons']['subtitle'] = ' -> メニュー -> ユーザー情報編集';
        $this->response['datas'] = ['user' => $user, 'genpassword' => $passwordUtil->generateStrongPassword()];
        if($authority == "1"){
            $allusers = User::orderBy('created_at','asc')->get();
            $this->response['datas'] = array_merge($this->response['datas'], ['allusers' => $allusers]);
        }

        return view('edituser/index', $this->response);
    }

    /**
     * 強力なパスワードを生成する
     *
     * @param Request $request
     * @return void
     */
    public function genpassword(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $authority = $request->session()->get('authority');

        $changeuser = $request->input('userlist');
        $changepassword = $request->input('password');
        $changeauthority = $request->input('authority');
        $changeban = $request->input('ban');
        $user = User::where('name', $changeuser)->first();
        $user->password = $changepassword;
        $user->authority = $changeauthority;
        $user->ban = $changeban;

        $passwordUtil = new PasswordUtil;

        $this->response['commons']['subtitle'] = ' -> メニュー -> ユーザー情報編集';
        $this->response['datas'] = ['user' => $user, 'genpassword' => $passwordUtil->generateStrongPassword()];
        if($authority == "1"){
            $allusers = User::orderBy('created_at','asc')->get();
            $this->response['datas'] = array_merge($this->response['datas'], ['allusers' => $allusers]);
        }

        return view('edituser/index', $this->response);
    }
   /**
     * ユーザー情報を修正する
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $authority = $request->session()->get('authority');
        $username = $request->session()->get('username');
        $user = User::where('name', $username)->first();

        $changeuser = $request->input('userlist');
        $changepassword = $request->input('password');
        $changeauthority = $request->input('authority');
        $changeban = $request->input('ban');

        $validator = Validator::make($request->all(), [
            'userlist'=>'required|max:256',
            'password'=>['required|max:256', new PasswordComplexity],
            'authority' => 'in:1,2',
            'ban' => 'in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $passwordUtil = new PasswordUtil;

        //一般ユーザーは権限やユーザー名を変更できない
        if($authority !="1"){
            //一般ユーザーで管理者になろうとしている
            if($changeauthority == "1"
            //一般ユーザーで管理者アカウント名になりすまそうとしている
            || $changeuser != $username
            //一般ユーザーでアカウント凍結を解除しようとしている
            || $changeban != $user->ban){
                $this->response['commons']['subtitle'] = ' -> メニュー -> ユーザー情報編集';
                $this->response['commons']['message'] = MessageUtil::MSG_ERR_0008;
                $this->response['commons']['messageType'] = MessageUtil::TYPE_DANGER;
                $this->response['datas'] = ['user' => $user, 'genpassword' => $passwordUtil->generateStrongPassword()];
                if($authority == "1"){
                    $allusers = User::orderBy('created_at','asc')->get();
                    $this->response['datas'] = array_merge($this->response['datas'], ['allusers' => $allusers]);
                }
                return view('edituser/index', $this->response);
            }
        }

        if($changeuser == ConstValue::SUPER_USER){
            //スーパーユーザーで権限を管理者以外に変更する
            if($changeauthority != "1"
            //スーパーユーザーでアカウントを凍結しようとする
            || $changeban == "1"){
                $this->response['commons']['subtitle'] = ' -> メニュー -> ユーザー情報編集';
                $this->response['commons']['message'] = MessageUtil::MSG_ERR_0007;
                $this->response['commons']['messageType'] = MessageUtil::TYPE_DANGER;
                $user = User::where('name', $username)->first();
                $this->response['datas'] = ['user' => $user, 'genpassword' => $passwordUtil->generateStrongPassword()];
                if($authority == "1"){
                    $allusers = User::orderBy('created_at','asc')->get();
                    $this->response['datas'] = array_merge($this->response['datas'], ['allusers' => $allusers]);
                }
                return view('edituser/index', $this->response);
            }
        }

        DB::transaction(function() use($changeuser, $changepassword, $changeauthority, $changeban){
            User::where('name', $changeuser)->update(['password'=>$changepassword, 'authority'=>$changeauthority, 'ban'=>$changeban]);
        });

        $savedUser = User::where('name', $changeuser)->first();
        $this->response['commons']['subtitle'] = ' -> メニュー -> ユーザー情報編集';
        $this->response['datas'] = ['savedUser' => $savedUser];
        
        $this->response['commons']['message'] = MessageUtil::MSG_INF_0009;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_SUCCESS;
        return view('edituser/result', $this->response);

    }
}
