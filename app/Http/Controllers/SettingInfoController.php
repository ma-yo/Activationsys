<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Commons\MessageUtil;
use App\SettingInfo;

/**
 * 設定値マスタ画面
 */
class SettingInfoController extends Controller
{
    /**
     * 設定値マスタ画面を表示する
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }   
        //シリアルキー関連付け解除最大回数
        $serialreset = SettingInfo::where('settingid', '0001')->first();
        //検索結果表示最大数
        $maxsearchrow = SettingInfo::where('settingid', '0002')->first();
        //シリアルキー最大登録数
        $maxissued = SettingInfo::where('settingid', '0003')->first();
        
        $this->response['commons']['subtitle'] = ' -> メニュー -> 設定値編集';
        $this->response['datas']['serialreset'] = $serialreset->value1;
        $this->response['datas']['maxsearchrow'] = $maxsearchrow->value1;
        $this->response['datas']['maxissued'] = $maxissued->value1;
        return view('settinginfo/index', $this->response);
    }

    
    /**
     * 設定値を変更する
     *
     * @param Request $request
     * @return void
     */
    public function update (Request $request)
    {
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        $serialreset = $request->input('serialreset-quantity');
        $maxsearchrow = $request->input('maxsearchrow-quantity');
        $maxissued = $request->input('maxissued-quantity');

        $validator = Validator::make($request->all(), [
            'serialreset-quantity'=>'required|integer|min:1',
            'maxsearchrow-quantity'=>'required|integer|min:1|max:10000',
            'maxissued-quantity'=>'required|integer|min:1|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        SettingInfo::where('settingid', '0001')->update(['value1' => $serialreset]);
        SettingInfo::where('settingid', '0002')->update(['value1' => $maxsearchrow]);
        SettingInfo::where('settingid', '0003')->update(['value1' => $maxissued]);

        $settinginfos = SettingInfo::all();
        $this->response['commons']['subtitle'] = ' -> メニュー -> 設定値編集';
        $this->response['commons']['message'] = MessageUtil::MSG_INF_0006;
        $this->response['commons']['messageType'] = MessageUtil::TYPE_SUCCESS;
        $this->response['datas']['settinginfos'] = $settinginfos;
        return view('settinginfo/result', $this->response);
    }
}
