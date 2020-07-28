<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivatedUser;
use App\SettingInfo;
/**
 * アクティベーションクラス
 */
class ActivateController extends Controller
{
    /**
     * 認証を行う
     * 
     *
     * @param Request $request
     * @return void
     */
    public function activate(Request $request){
        $serial = $request->input('serialid');
        $deviceid = $request->input('deviceid');

        //認証ユーザーテーブルよりシリアルキーにてデータを取得する
        $activatedUser = ActivatedUser::where('serialid', $serial)->first();
        //シリアルキーが存在しない場合はエラーとして返す
        if(empty($activatedUser)){
            return response()->json(['result'=>'fail', 'code' => '101', 'devchangelimit'=> '', 'description'=>'入力されたシリアルキーは存在しません。']);
        }
        //シリアルキーが見つかったが、アカウントが削除されている場合は、エラーとして返す
        if($activatedUser->ban != null){
            return response()->json(['result'=>'fail', 'code' => '102', 'devchangelimit'=> '', 'description'=>'シリアルキーはロックされています。']);
        }
        //デバイスIDパラメーターが渡されていない場合は、エラーとして返す
        if(empty($deviceid)){
            return response()->json(['result'=>'fail', 'code' => '103','devchangelimit'=> '',  'description'=>'認証に必要なパラメーターが不足しています。']);
        }

        $serialreset = SettingInfo::where('settingid', '0001')->first()->value1;
        if($activatedUser->devicechangecount > $serialreset){
            return response()->json(['result'=>'fail', 'code' => '105','devchangelimit'=> ($serialreset - ($activatedUser->devicechangecount - 1)),  'description'=>'デバイス認証回数制限を超えています。シリアルキーはロックされました。']);
        }
        //デバイスIDが一致した場合は認証OKとする
        if($activatedUser->deviceid == $deviceid){
            return response()->json(['result'=>'success', 'code' => '001', 'devchangelimit'=> ($serialreset - ($activatedUser->devicechangecount - 1)), 'description'=>'シリアルキーはお使いのデバイスに認証されています。']);
        }
        //デバイスIDがDBに保存されていない状態は、認証するPCがシリアルに関連付けられていない場合となる。
        //この場合は、デバイスIDをシリアルキーに紐づけ、認証OKとする
        if(empty($activatedUser->deviceid)){
            $activatedUser->deviceid = $deviceid;
            $activatedUser->devicechangecount++;
            ActivatedUser::where('serialid', $serial)->update(['deviceid' => $deviceid, 'devicechangecount'=> ($activatedUser->devicechangecount)]);
            return response()->json(['result'=>'success', 'code' => '002','devchangelimit'=> ($serialreset - ($activatedUser->devicechangecount - 1)), 'description'=>'シリアルキーを認証しました。']);
        }
        //デバイスIDがDBに登録されているものと一致しない場合は、別PCから実行されている可能性があるため、エラーとして返す
        return response()->json(['result'=>'fail', 'code' => '104','devchangelimit'=> $activatedUser->devicechangecount,  'description'=>'このシリアルキーは他のデバイスにて認証されています。']);
    }
        /**
     * 認証解除を行う
     * 
     *
     * @param Request $request
     * @return void
     */
    public function deactivate(Request $request){
        $serial = $request->input('serialid');
        $email = $request->input('email');

        //認証ユーザーテーブルよりシリアルキーにてデータを取得する
        $activatedUser = ActivatedUser::where('serialid', $serial)->first();
        //シリアルキーが存在しない場合はエラーとして返す
        if(empty($activatedUser)){
            return response()->json(['result'=>'fail', 'code' => '101', 'devchangelimit'=> '', 'description'=>'入力されたシリアルキーは存在しません。']);
        }
        //シリアルキーが見つかったが、アカウントが削除されている場合は、エラーとして返す
        if($activatedUser->ban != null){
            return response()->json(['result'=>'fail', 'code' => '102', 'devchangelimit'=> '', 'description'=>'シリアルキーはロックされています。']);
        }
        //EMAILパラメーターが渡されていない場合は、エラーとして返す
        if(empty($email)){
            return response()->json(['result'=>'fail', 'code' => '103', 'devchangelimit'=> '', 'description'=>'認証に必要なパラメーターが不足しています。']);
        }
        $serialreset = SettingInfo::where('settingid', '0001')->first()->value1;
        //デバイスIDが一致した場合は認証解除する
        if(strtoupper($activatedUser->email) == strtoupper($email)){
            ActivatedUser::where('serialid', $serial)->update(['deviceid' => null]);
            return response()->json(['result'=>'success', 'code' => '001','devchangelimit'=> ($serialreset - ($activatedUser->devicechangecount - 1)), 'description'=>'認証を解除しました。']);
        }
        //デバイスIDがDBに登録されているものと一致しない場合は、別PCから実行されている可能性があるため、エラーとして返す
        return response()->json(['result'=>'fail', 'code' => '104','devchangelimit'=> ($serialreset - ($activatedUser->devicechangecount - 1)), 'description'=>'このシリアルキーは他のユーザーにて認証されています。']);
    }
}
