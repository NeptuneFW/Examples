<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 22.04.2017
 * Time: 18:43
 */

namespace App\Admin\Http\Controller;

require "Article.php";
require "User.php";

use Database\Databases\Model\ParentModel;
use Database\Databases\Ntuser\UsersTable;
use duncan3dc\Laravel\Blade;
use Libs\Languages;
use System\Response;
use System\Session;
use Tarvos\Tarvos;

class Home
{

    use \System\Core;

    public function index()
    {

        $data['js'] = $this->assets->getAssetsGroup('main')->useAllAssets('js')->returnedData;
        $data['js'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('js')->returnedData;
        $data['css'] = $this->assets->getAssetsGroup('main')->useAllAssets('css')->returnedData;
        $data['css'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('css')->returnedData;
        $data['title'] = ParentModel::getTitle() . ' - ' . Languages::temporarilySet(['tr_TR' => 'Yönetici Paneli', 'en_US' => 'Dashboard']);
        if(Session::exists('errors')) $data['errors'] = Session::get('errors');
        if(Session::exists('alerts')) $data['alerts'] = Session::get('alerts');
        $category_list = (new Category)->categoryListCore(4);
        $data['categories'] = $category_list[0];
        $data['categories_for_post'] = $category_list[0];
        $data['page_categories'] = $category_list[1];
        $data['js'] .= $this->assets->getAssetsGroup('tinyMCE')->useAllAssets('js')->returnedData;
        $articles = (new Article())->articlesListCore();
        $data['articles'] = $articles[0];
        $users = (new User())->userListCore();
        $data['users'] = $users[0];
        $data['page_articles'] = $articles[1];
        $data['page_users'] = $users[1];

        echo Blade::render('admin/admin', $data);
    }

    public function logout()
    {
        Session::destroy();
        Response::route("logout")->go();
    }

    public function login()
    {
        $data['css'] = $this->assets->getAssetsGroup("login")->useAllAssets("css")->returnedData;
        $data['js'] = $this->assets->getAssetsGroup("login")->useAllAssets("js")->returnedData;
        $data['title'] = Languages::show("Log in") . ' - ' . ParentModel::getTitle();

        echo Blade::render('admin/login', $data);
    }

    public function loginPost()
    {
        if(\Libs\Input::exists())
        {
            $usersTable = new UsersTable();
            $user = $usersTable->where("email", "=", \Libs\Input::get("email"))->andWhere("password", "=", md5(\Libs\Input::get("password")))->execute();
            if($user != false)
            {
                $user = $user->first();
                Session::set("login", true);
                Session::set("id", $user->id);
                Session::set("name", $user->name);
                Session::set("surname", $user->surname);
                Session::set("rank", $user->rank);
                Session::set("email", $user->email);

                if($user->rank == 1)
                {
                    Response::route("admin")->go();
                }
                else
                {
                    header("Location " . BASE_URL);
                }
            }
            else
            {
                $data['css'] = $this->assets->getAssetsGroup("login")->useAllAssets("css")->returnedData;
                $data['js'] = $this->assets->getAssetsGroup("login")->useAllAssets("js")->returnedData;
                $data['title'] = Languages::show("Log in") . ' - ' . ParentModel::getTitle();
                $data['error'] = "Üzgünüz böyle bir kullanıcı yok.";

                $tarvos = new Tarvos();
                $tarvos->render("admin/login", $data, true, 3);
            }
        }
    }

}