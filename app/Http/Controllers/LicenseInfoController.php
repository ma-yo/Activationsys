<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LicenseInfo;
use App\Commons\MessageUtil;
use Illuminate\Support\Facades\DB;
use App\SettingInfo;

class LicenseInfoController extends Controller
{
    /**
     * ライセンス一覧画面
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
        $licenseinfos = $this->getLicenseData(null);
        $this->response['commons']['subtitle'] = ' -> メニュー -> ライセンス情報';
        $this->response['datas'] = ['licenseinfos' => $licenseinfos, 'searchword' => ''];
        return view('licenseinfo/index', $this->response);
    }

        /**
     * シリアルを検索する
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request){

        //csrf対策
        $request->session()->regenerateToken();
        //ログイン状態判定
        if(!$this->checkLogin($request)){
            return view('login/index', $this->response);
        }

        //検索文字列
        $word = $request->input('searchword');
        $licenseinfos = null;

        if(empty($word)){
            $licenseinfos = LicenseInfo::take(100)->orderBy('updated_at','desc')->orderBy('created_at','desc')->get();
        }else{
            //名称とEMAILであいまい検索を行う

            $licenseinfos = $this->getLicenseData($word);
           
        }
        $this->response['commons']['subtitle'] = ' -> メニュー -> ライセンス情報';
        $this->response['datas'] = ['licenseinfos' => $licenseinfos, 'searchword' => $word];
        //データ件数をメッセージに出力する
        $count = count($licenseinfos);
        if($count > 0){
            $this->response['commons']['message'] = $count . MessageUtil::MSG_INF_0005;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_SUCCESS;
        }else{
            $this->response['commons']['message'] = MessageUtil::MSG_ERR_0005;
            $this->response['commons']['messageType'] = MessageUtil::TYPE_WARNING;
        }
        return view('licenseinfo/index', $this->response);
    }

    /**
     * ライセンス情報を取得する
     *
     * @param [type] $word
     * @return void
     */
    private function getLicenseData($word){
        $sql = 'select license_infos.licenseid';
        $sql .= ',activated_users.name as username';
        $sql .= ',activated_users.email';
        $sql .= ',applications.name as appname';
        $sql .= ',license_infos.created_at';
        $sql .= ',license_infos.updated_at';
        $sql .= ',count(activated_users.serialid) licensecount';
        $sql .= ' from license_infos';
        $sql .= ' inner join activated_users';
        $sql .= ' on license_infos.licenseid = activated_users.licenseid';
        $sql .= ' inner join applications';
        $sql .= ' on applications.appid = activated_users.appid';
        $sql .= ' where activated_users.ban is null';
        
        $prepare = [];
        if($word != null){
            $sql .= ' and (';
            $list = explode(' ', $word);
            foreach($list as $idx => $like){
                if($idx>0){
                    $sql .= " or ";
                }
                $sql .= "activated_users.name like ?";
                $sql .= " or activated_users.email like ?";
                $sql .= " or license_infos.licenseid like ?";
                $sql .= " or applications.name like ?";
                $prepare[] = "%$like%";
                $prepare[] = "%$like%";
                $prepare[] = "%$like%";
                $prepare[] = "%$like%";
            }
            $sql .= ' )';
        }

        $sql .= ' GROUP BY license_infos.licenseid';
        $sql .= ',activated_users.name';
        $sql .= ',activated_users.email';
        $sql .= ',applications.name ';
        $sql .= ',license_infos.created_at';
        $sql .= ',license_infos.updated_at';
        $sql .= ' ORDER BY license_infos.updated_at desc';
        $sql .= ' , license_infos.created_at desc';
        $sql .= ' limit ?';
        $prepare[] = $this->getMaxSearchRow();
        return DB::select($sql, $prepare);
    }
    /**
     * 最大表示行数を取得する
     *
     * @return void
     */
    private function getMaxSearchRow(){
        $maxsearchrow = SettingInfo::where('settingid', '0004')->first();
        return $maxsearchrow->value1;
    }
}
