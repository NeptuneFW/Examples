<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 20.05.2017
 * Time: 00:55
 */

namespace App\Production\Http\Controller;


use System\Cookie;
use System\Response;

class Color
{

    public function index($color)
    {
        Cookie::set('color2', $color, true, time()+60*60*24*30*12*10);
        Response::back();
    }

}