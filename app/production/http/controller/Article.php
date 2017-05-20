<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 06.05.2017
 * Time: 00:16
 */

namespace App\Production\Http\Controller;
use Database\Databases\Model\ParentModel;
use Database\Databases\Ntblog\CommentsTable;
use Database\Databases\Ntblog\LikesTable;
use Database\Databases\Ntuser\UsersTable;
use duncan3dc\Laravel\Blade;
use Libs\Errors\ErrorHandler;
use System\Request;
use System\Response;
use \Database\Databases\Ntblog\ArticlesTable;
use System\Session;
require "Home.php";

class Article
{

    public function index($title, $id)
    {
        $data = (new Home)->core();
        $data['back'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
        $post = ArticlesTable::find($id);
        if($post !== false)
        {
            if($post->deleted == 0)
            {
                if(\System\Helper::permalink($post->title) == $title) {
                    $data['post_title'] = $post->title;
                    $data['post_id'] = $post->id;
                    $data['title_head'] = $post->title . " - " . ParentModel::getTitle();
                    $data['post_content'] = html_entity_decode($post->content);
                    $user = UsersTable::find($post->user);
                    if ($user != false) {
                        $data['user'] = $user->name . ' ' . $user->surname;
                        $data['picture'] = $user->picture;
                    } else {
                        $data['user'] = "Silinmiş üye";
                    }
                    $is_liked = (new LikesTable)->where('user', '=', $user->id)->andWhere('post', '=', $post->id)->execute();
                    $data['liked'] = $is_liked !== false ? true : false;
                    $data['time'] = $post->created;
                    $data['like_count'] = $post->likes;
                    $comments = (new CommentsTable())->where("post_id", "=", $post->id)->andWhere("deleted", "=", "0")->execute();
                    if ($comments !== false) {
                        $data['comments'] = $comments->all();
                    } else {
                        $data['comments'] = $comments;
                    }
                }
                else
                {
                    die(ErrorHandler::page404());
                }
            }
            else
            {
                die(ErrorHandler::page404());
            }
        }
        else
        {
            die(ErrorHandler::page404());
        }
        echo Blade::render('article', $data);
    }

    public function like($id)
    {
        if(is_numeric($id))
        {
            if(Session::exists('login'))
            {
                if(ArticlesTable::find($id) !== false)
                {
                    if((new LikesTable())->where('user', '=', Session::get('id'))->andWhere('post', '=', $id)->execute() == false) {
                        LikesTable::add(null, Session::get('id'), $id);
                        $article = (new ArticlesTable())->where('id', '=', $id)->execute()->first();
                        $article->likes += 1;
                        $article->save();
                    }
                }
            }
        }
        Response::back();
    }

    public function unlike($id)
    {
        if(is_numeric($id))
        {
            if(Session::exists('login'))
            {
                if(ArticlesTable::find($id) !== false)
                {
                    if ((new LikesTable())->where('user', '=', Session::get('id'))->andWhere('post', '=', $id)->execute() != false) {
                        (new LikesTable())->where('user', '=', Session::get('id'))
                            ->andWhere('post', '=', $id)
                            ->execute()
                            ->first()
                            ->delete();
                        $article = (new ArticlesTable())->where('id', '=', $id)->execute()->first();
                        $article->likes -= 1;
                        $article->save();
                    }
                }
            }
        }
        Response::back();
    }

}