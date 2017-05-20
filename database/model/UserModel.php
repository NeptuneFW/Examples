<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 01.05.2017
 * Time: 21:38
 */

namespace Database\Databases\Model;


class UserModel
{

    public static function rank($rank)
    {
        switch ($rank){
            case 0:
                return \Libs\Languages::show('Normal user');
                break;
            case 1:
                return \Libs\Languages::show('Administrator');
                break;
        }
    }

}