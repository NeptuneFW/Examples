<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 23.04.2017
 * Time: 12:39
 */

namespace App\Admin\Http\Middleware;


use Libs\Errors\ErrorHandler;
use System\Response;
use System\Session;

class AuthMiddleware
{

    public static function isLogin()
    {
        if(Session::exists('login'))
        {
            return true;
        }
        Response::route('login')->go();
        return false;
    }

    public static function isNotLogin()
    {
        if(!Session::exists('login'))
        {
            return true;
        }
        Response::route('admin')->go();
        return false;
    }

    public static function isAdmin()
    {
        if(Session::get('rank')  == 1)
        {
            return true;
        }
        ErrorHandler::show("Bu alana erişim izniniz yok!");
        return false;
    }

}