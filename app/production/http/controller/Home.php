<?php

namespace App\Production\Http\Controller;

use App\Admin\Http\Controller\Category;
use Database\Databases\Model\ParentModel;
use Database\Databases\Ntblog\ArticlesTable;
use Database\Databases\Ntblog\CategoriesRow;
use Database\Databases\Ntblog\CategoriesTable;
use Database\Databases\Ntblog\LikesTable;
use Database\Databases\Ntblog\SettingsTable;
use Database\Databases\Ntuser\UsersTable;
use duncan3dc\Laravel\Blade;
use duncan3dc\Laravel\BladeInstance;
use Libs\Connect\Connect;
use Libs\Errors\ErrorHandler;
use Libs\Upload\Upload;
use Libs\Validator\Validator;
use Libs\Input;
use System\Cookie;
use System\Session;
use System\Response;
use Libs\Languages;
use Illuminate\View\Compilers\BladeCompiler;

class Home
{
    use \System\Core;


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

    public function register()
    {
        $data['css'] = $this->assets->getAssetsGroup("login")->useAllAssets("css")->returnedData;
        $data['js'] = $this->assets->getAssetsGroup("login")->useAllAssets("js")->returnedData;
        $data['title'] = Languages::show("Log in") . ' - ' . ParentModel::getTitle();

        echo Blade::render('register', $data);

    }

    public function registerPost()
    {
        $picture = Upload::getUpload("picture");
        if(\Libs\Input::exists())
        {
            if(!empty(Input::get('name')) && !empty(Input::get('surname')) && !empty(Input::get('name')) && !empty(Input::get('name')))

                $is_email = filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL);
                if($is_email !== false) {

                    $user_id = UsersTable::add(null, Input::get('name'), Input::get('surname'), null, $is_email, null, null,null, md5(Input::get('password')), $picture );

                    Session::set("login", true);
                    Session::set("id", $user_id[1]);
                    Session::set("name", Input::get('name'));
                    Session::set("surname", Input::get('surname'));
                    Session::set("rank", 0);
                    Session::set("email", Input::get('email'));

                    Response::route('home')->go(0.05);

                }
        }
    }

    public function core()
    {
        $data['languages'] = ParentModel::getLanguages();
        $data['js'] = $this->assets->getAssetsGroup("main")->useAllAssets("js")->returnedData;
        $data['js'] .= $this->assets->getAssetsGroup('blog')->useAllAssets('js')->returnedData;
        $data['css'] = $this->assets->getAssetsGroup("main")->useAllAssets("css")->returnedData;
        $data['css'] .= $this->assets->getAssetsGroup('blog')->useAllAssets('css')->returnedData;
        $data['title'] = ParentModel::getTitle();
        return $data;
    }

    public function index()
    {
        $data = $this->core();
        $data['title_head'] = ParentModel::getTitle();
        $articles = ArticlesTable::all(null, 'array');
        if($articles != false)
        {
            $data['posts'] = $articles;
        }
        else
        {
            $data['posts'] = false;
        }
        echo Blade::render("home", $data);
    }

    public function lang($lang)
    {
        Cookie::set('lang', $lang);
        Response::back();
    }

    public function catList()
    {
        $data = $this->core();
        $data['title_head'] = Languages::show('Categories') . ' - ' . ParentModel::getTitle();
        $data['categories'] = CategoriesTable::all(null, 'array');
        echo Blade::render("categories", $data);
    }

}