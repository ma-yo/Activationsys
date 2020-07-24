<?php

namespace App\Http\Controllers;
use App\Commons\MessageUtil;
use App\ActivatedUser;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

/**
 * シリアルキー作成処理
 */
class GenSerialController extends Controller
{

    /**
     * シリアル生成ページ
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
        return view('genserial/index', $this->response);
    }

    /**
     * シリアル生成を行う
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
        $email = $request->input('email');
        $quant = $request->input('quant');

        $validator = Validator::make($request->all(), [
            'username'=>'required',
            'email'=>'required|email',
            'quant'=>'required|integer|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //シリアルキーを生成する処理
        $serials = [];
        for ($i = 0; $i <  $quant; $i++) {
            $serials[] = $this->createSerial();
        }
        
        $activatedUsers = $this->createActivatedUsers($serials, $username, $email);

        $this->response['commons']['message'] = MessageUtil::MSG_INF_0004;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_SUCCESS;
        $this->response['datas'] = ['activatedUsers' => $activatedUsers];
        return view('genserial/result', $this->response);
    }

    /**
     * 32桁のシリアルキーを生成する
     *
     * @return String
     */
    private function createSerial(){
        $serial = strtoupper(md5(uniqid(rand(),1)));
        $serial1 = substr ( $serial  ,0 , 4 );
        $serial2 = substr ( $serial  ,4 , 4 );
        $serial3 = substr ( $serial  ,8 , 4 );
        $serial4 = substr ( $serial  ,12 , 4 );
        $serial5 = substr ( $serial  ,16 , 4 );
        $serial6 = substr ( $serial  ,20 , 4 );
        $serial7 = substr ( $serial  ,24 , 4 );
        $serial8 = substr ( $serial  ,28 , 4 );
        $serial = $serial1 . "-" . $serial2 . "-" . $serial3 . "-" . $serial4 . "-" . $serial5 . "-" . $serial6 . "-" . $serial7 . "-" . $serial8;
        return $serial;
    }

    /**
     * シリアルキーをDBに保存する
     *
     * @param Array $serials
     * @param String $username
     * @param String $email
     * @return ActivatedUser
     */
    private function createActivatedUsers($serials, $username, $email){
        
        $activatedUsers = DB::transaction(function () use ( $serials, $username, $email) {
            $array = [];
            foreach ($serials as $serial){
                while(true){
                    $activatedUser = ActivatedUser::where('serialid',$serial)->first();
                    if($activatedUser == null){
                        $activatedUser = new ActivatedUser;
                        $activatedUser->serialid = $serial;
                        $activatedUser->name = $username;
                        $activatedUser->email = $email;
                        $activatedUser->created_at = new DateTime();
                        $activatedUser->save();
                        $array[] = $activatedUser;
                        break;
                    }
                }
            }
            return $array;
        });

        return $activatedUsers;
    }
}
