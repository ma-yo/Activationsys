<?php

namespace App\Http\Controllers;
use App\Commons\MessageUtil;
use App\ActivatedUser;
use DateTime;

use Illuminate\Http\Request;

class GenSerialController extends Controller
{
    public function index (Request $request)
    {
        $request->session()->regenerateToken();
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $content = $request->input('content');
        switch($content){
            case "genserial":
                return $this->genserial($request);
            case "menu":
                return view('menu/index', $this->response);
        }
        
        //処理が存在しない場合
        return $this->getNoPageFound($request);
    }

    //シリアル生成ページへ移動
    private function genserial (Request $request){

        $username = $request->input('username');
        $email = $request->input('email');

        if(empty($username) || empty($email)){
            $this->response['message'] = MessageUtil::MSG_ERR_0004;
            $this->response['messageType'] = MessageUtil::TYPE_DANGER;
            return view('genserial/index', $this->response);
        }

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

        $activatedUser = null;
        while(true){
            $activatedUser = ActivatedUser::where('serialid',$serial)->first();
            if($activatedUser == null){
                $activatedUser = new ActivatedUser;
                $activatedUser->serialid = $serial;
                $activatedUser->name = $username;
                $activatedUser->email = $email;
                $activatedUser->created_at = new DateTime();
                $activatedUser->save();
                break;
            }
        }

        
        $this->response['message'] = MessageUtil::MSG_INF_0004;
        $this->response['messageType'] = MessageUtil::TYPE_SUCCESS;
        $this->response['serial'] = $serial;
        $this->response['activateduser'] = $username;
        $this->response['created_at'] = $activatedUser->created_at;
        $this->response['email'] = $email;
        return view('genserial/result', $this->response);
    }
}
