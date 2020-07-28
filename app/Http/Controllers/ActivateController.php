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
            return response()->json(['result'=>'fail', 'code' => '101', 'devchangelimit'=> '', 'description'=>'シリアルキーが見つかりません。']);
        }
        //シリアルキーが見つかったが、アカウントが削除されている場合は、エラーとして返す
        if($activatedUser->ban != null){
            return response()->json(['result'=>'fail', 'code' => '102', 'devchangelimit'=> '', 'description'=>'シリアルキーは非許可に設定されています。']);
        }
        //デバイスIDパラメーターが渡されていない場合は、エラーとして返す
        if(empty($deviceid)){
            return response()->json(['result'=>'fail', 'code' => '103','devchangelimit'=> '',  'description'=>'デバイスIDパラメーターが見つかりません。']);
        }

        $serialreset = SettingInfo::where('settingid', '0001')->first()->value1;
        if($activatedUser->devicechangecount > $serialreset){
            return response()->json(['result'=>'fail', 'code' => '105','devchangelimit'=> ($serialreset - $activatedUser->devicechangecount + 1),  'description'=>'デバイス認証回数制限を超えています。シリアルキーはロックされました。']);
        }
        //デバイスIDが一致した場合は認証OKとする
        if($activatedUser->deviceid == $deviceid){
            return response()->json(['result'=>'success', 'code' => '001', 'devchangelimit'=> ($serialreset - $activatedUser->devicechangecount + 1), 'description'=>'シリアルキーとデバイスIDが一致しました。', 'user' => $activatedUser]);
        }
        //デバイスIDがDBに保存されていない状態は、認証するPCがシリアルに関連付けられていない場合となる。
        //この場合は、デバイスIDをシリアルキーに紐づけ、認証OKとする
        if(empty($activatedUser->deviceid)){
            $activatedUser->deviceid = $deviceid;
            $activatedUser->devicechangecount++;
            ActivatedUser::where('serialid', $serial)->update(['deviceid' => $deviceid, 'devchangelimit'=> ($serialreset - $activatedUser->devicechangecount + 1)]);
            return response()->json(['result'=>'success', 'code' => '002','devchangelimit'=> ($serialreset - $activatedUser->devicechangecount + 1), 'description'=>'デバイスIDをシリアルキーに新規関連付けしました。', 'user' => $activatedUser]);
        }
        //デバイスIDがDBに登録されているものと一致しない場合は、別PCから実行されている可能性があるため、エラーとして返す
        return response()->json(['result'=>'fail', 'code' => '104','devchangelimit'=> $activatedUser->devicechangecount,  'description'=>'デバイスIDが一致しません。']);
    }
        /**
     * 認証を行う
     * 
     *
     * @param Request $request
     * @return void
     */
    public function deactivate(Request $request){
        $serial = $request->input('serialid');
        $deviceid = $request->input('deviceid');

        //認証ユーザーテーブルよりシリアルキーにてデータを取得する
        $activatedUser = ActivatedUser::where('serialid', $serial)->first();
        //シリアルキーが存在しない場合はエラーとして返す
        if(empty($activatedUser)){
            return response()->json(['result'=>'fail', 'code' => '101', 'devchangelimit'=> '', 'description'=>'シリアルキーが見つかりません。']);
        }
        //シリアルキーが見つかったが、アカウントが削除されている場合は、エラーとして返す
        if($activatedUser->ban != null){
            return response()->json(['result'=>'fail', 'code' => '102', 'devchangelimit'=> '', 'description'=>'シリアルキーは非許可に設定されています。']);
        }
        //デバイスIDパラメーターが渡されていない場合は、エラーとして返す
        if(empty($deviceid)){
            return response()->json(['result'=>'fail', 'code' => '103', 'devchangelimit'=> '', 'description'=>'デバイスIDパラメーターが見つかりません。']);
        }
        $serialreset = SettingInfo::where('settingid', '0001')->first()->value1;
        //デバイスIDが一致した場合は認証OKとする
        if($activatedUser->deviceid == $deviceid){
            $rimit = $serialreset - ($activatedUser->devicechangecount - 1);
            ActivatedUser::where('serialid', $serial)->update(['deviceid' => null]);
            return response()->json(['result'=>'success', 'code' => '001','devchangelimit'=> ($serialreset - $activatedUser->devicechangecount + 1), 'description'=>'認証を解除しました。再認証可能回数は残り' . $rimit  . '回です。' , 'user' => $activatedUser]);
        }
        //デバイスIDがDBに保存されていない状態は、認証するPCがシリアルに関連付けられていない場合となる。
        //この場合は、デバイスIDをシリアルキーに紐づけ、認証OKとする
        if(empty($activatedUser->deviceid)){
            return response()->json(['result'=>'fail', 'code' => '105','devchangelimit'=> ($serialreset - $activatedUser->devicechangecount + 1), 'description'=>'デバイスIDはシリアルキーに関連付けられていません。', 'user' => $activatedUser]);
        }
        //デバイスIDがDBに登録されているものと一致しない場合は、別PCから実行されている可能性があるため、エラーとして返す
        return response()->json(['result'=>'fail', 'code' => '104','devchangelimit'=> ($serialreset - $activatedUser->devicechangecount + 1), 'description'=>'デバイスIDが一致しません。']);
    }
}
