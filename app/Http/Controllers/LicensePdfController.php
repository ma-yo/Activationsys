<?php

namespace App\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use App\ActivatedUser;
use DateTime;
use Log;

class LicensePdfController extends Controller
{
    public function index(Request $request){
        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }
        
        $licid = $request->input('licid');
        $activatedUsers = ActivatedUser::where('licenseid', $licid)->get(); 
        $username = $activatedUsers[0]->name;
        $date = new DateTime();
        $filename = $date->format('Y-m-d-H-i-s') . '-' . $username . '様-license.pdf';
        $filename = str_replace(array("\r\n","\r","\n"), " ", $filename);
        $filename = htmlspecialchars_decode($filename);
        $filename = str_replace(array("\\","/",":",",",";","*","?","<",">","|"), array("￥","／","：","，","；","＊","？","＜","＞","｜"), $filename);

        $serialids = [];
        foreach($activatedUsers as $user){
            $serialids[] = $user->serialid;
        }
        $created_at = $activatedUsers[0]->created_at->format('Y-m-d');
        $applicatoin = $activatedUsers[0]->application->first()->name;
        $response = SnappyPdf::loadView('pdf/license', ['created_at'=> $created_at
        ,'serialids' =>  $serialids
        ,'productname' => $applicatoin 
        , 'username'=> $username
        , 'licenseid' => $licid])->download();
        $response->header("Content-Disposition", "attachment; filename*=UTF-8''" . rawurlencode($filename));
        return $response; 

    }
}
