<?php
namespace app\Commons;

/**
 * パスワード生成クラス
 */
class PasswordUtil
{
    function generateStrongPassword($length = 8, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '123456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
    
        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
    
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
    
        $password = str_shuffle($password);
    
        
        return $password;
    }
}