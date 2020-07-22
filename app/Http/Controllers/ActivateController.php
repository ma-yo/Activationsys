<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivatedUser;

//アクティベーションクラス
class ActivateController extends Controller
{
    //認証を行う
    public function activate(Request $request){
        $serial = $request->input('serialid');
        $bios = $request->input('biosid');
        $activatedUser = ActivatedUser::where('serialid', $serial)->first();

        if(empty($activatedUser)){
            return response()->json(['result'=>'error', 'description'=>'parameter serialid not found']);
        }
        if($activatedUser->ban != null){
            return response()->json(['result'=>'error', 'description'=>'serialid was ban!!']);
        }
        if(empty($bios)){
            return response()->json(['result'=>'error', 'description'=>'parameter biosid not found']);
        }
        if($activatedUser->biosid == $bios){
            return response()->json(['result'=>'ok', 'description'=>'parameter biosid match', 'user' => $activatedUser]);
        }else{
            if(empty($activatedUser->biosid)){
                $activatedUser->biosid = $bios;
                ActivatedUser::where('serialid', $serial)->update(['biosid' => $bios]);
                return response()->json(['result'=>'ok', 'description'=>'parameter biosid saved', 'user' => $activatedUser]);
            }
            return response()->json(['result'=>'error', 'description'=>'biosid not match']);
        }
    }
}
