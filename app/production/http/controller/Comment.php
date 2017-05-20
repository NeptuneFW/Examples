<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 06.05.2017
 * Time: 15:46
 */

namespace App\Production\Http\Controller;

use Database\Databases\Ntblog\CommentsTable;
use Libs\Input;
use System\Session;
use System\Response;
use Database\Databases\Ntblog\ArticlesTable;

class Comment
{

    public function add()
    {
        if(Input::exists())
        {
            if(!empty(Input::get('comment') AND !empty(Input::get('post_id'))))
            {
                (new CommentsTable())->add(null, Input::get('post_id'), \System\Session::get("id"), Input::get('comment'));
                Session::set('alerts',  [ \Libs\Languages::temporarilySet(['tr_TR' => 'Yorum eklendi.', 'en_US' => 'Comment added.'])]);
                Response::back(0.05);
            }
            else
            {
                Session::set('errors', [ \Libs\Languages::temporarilySet(['tr_TR' => 'Lütfen boş alan bırakmayınız.', 'en_US' => 'Please do not leave blank input field.'])]);
                Response::back(0.05);
            }

        }
    }

}