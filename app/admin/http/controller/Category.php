<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 24.04.2017
 * Time: 22:57
 */

namespace App\Admin\Http\Controller;

use Database\Databases\Ntblog\CategoriesTable;
use Database\Databases\Ntblog\SettingsTable;
use duncan3dc\Laravel\Blade;
use Libs\Input;
use System\Core;
use System\Response;
use System\Session;
use Database\Databases\Model\ParentModel;
use Libs\Languages;

class Category
{
    use Core;

    public function index()
    {
        $data['js'] = $this->assets->getAssetsGroup('main')->useAllAssets('js')->returnedData;
        $data['js'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('js')->returnedData;
        $data['css'] = $this->assets->getAssetsGroup('main')->useAllAssets('css')->returnedData;
        $data['css'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('css')->returnedData;
        $data['title'] = ParentModel::getTitle() . ' - ' . Languages::show("Dashboard");
        if(Session::exists('errors')) $data['errors'] = Session::get('errors');
        if(Session::exists('alerts')) $data['alerts'] = Session::get('alerts');

        $categoryList = $this->categoryListCore(5);

        $data['categories'] = $categoryList[0];
        $data['page_categories'] = $categoryList[1];

        echo Blade::render('admin/category', $data);
    }

    public function list()
    {
        $data['js'] = $this->assets->getAssetsGroup('main')->useAllAssets('js')->returnedData;
        $data['js'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('js')->returnedData;
        $data['css'] = $this->assets->getAssetsGroup('main')->useAllAssets('css')->returnedData;
        $data['css'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('css')->returnedData;
        $data['title'] = ParentModel::getTitle() . ' - ' . Languages::show("Dashboard");
        if(Session::exists('errors')) $data['errors'] = Session::get('errors');
        if(Session::exists('alerts')) $data['alerts'] = Session::get('alerts');

        $categoryList = $this->categoryListCore(5);

        $data['categories'] = $categoryList[0];
        $data['page_categories'] = $categoryList[1];

        echo Blade::render("admin/category/list", $data);
    }

    public function core()
    {
        $data['js'] = $this->assets->getAssetsGroup('main')->useAllAssets('js')->returnedData;
        $data['js'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('js')->returnedData;
        $data['css'] = $this->assets->getAssetsGroup('main')->useAllAssets('css')->returnedData;
        $data['css'] .= $this->assets->getAssetsGroup('dashboard')->useAllAssets('css')->returnedData;
        $data['title'] = ParentModel::getTitle() . ' - ' . Languages::show("Dashboard");
        if(Session::exists('errors')) $data['errors'] = Session::get('errors');
        if(Session::exists('alerts')) $data['alerts'] = Session::get('alerts');
        return $data;
    }

    public function add()
    {
        $data = $this->core();
        echo Blade::render("admin/category/add", $data);
    }

    public function categoryListCore($record = 10)
    {
        $categoryCount = CategoriesTable::count();
        if(isset($_GET['s']) AND is_numeric($_GET['s']))
        {
            $page = $_GET['s'];
        }
        else
        {
            $page = 1;
        }
        $page_count = ceil($categoryCount/$record);
        $where = ($page*$record)-$record;

        $data = CategoriesTable::orderBy('DESC', $where . ',' . $record, "deleted=0", "array");
        if(!$data)
        {
            return [false, 0];
        }
        else
        {
            return [$data, $page_count];
        }

    }

    public function edit($id)
    {
        $data = $this->core();
        $tarvos = new Tarvos();
        $data['edit'] = true;
        $category = CategoriesTable::find($id);
        $data['name'] = $category->name;
        $data['description'] = $category->description;
        $tarvos->render("admin/category/add", $data);
    }

    public function editPost($id)
    {
        if(Input::exists())
        {
            if(!empty(Input::get('category_name') AND !empty(Input::get('category_description'))))
            {
                $category = CategoriesTable::find($id);
                $category->name = Input::get('category_name');
                $category->description = Input::get('category_description');
                $return = $category->save();
                if($return[0])
                {
                    Session::set('alerts',  [ \Libs\Languages::temporarilySet(['tr_TR' => 'Kategori güncellendi.', 'en_US' => 'Category updated.'])]);
                }
                else
                {
                    Session::set('errors',  [ \Libs\Languages::temporarilySet(['tr_TR' => 'Bir sorun oluştu.', 'en_US' => 'There was a problem.'])]);
                }
                Response::back(0.05);
            }
            else
            {
                Session::set('errors', [ \Libs\Languages::temporarilySet(['tr_TR' => 'Lütfen boş alan bırakmayınız.', 'en_US' => 'Please do not leave blank input field.'])]);
                Response::back(0.05);
            }

        }
    }

    public function addPost()
    {
        if(Input::exists())
        {
            if(!empty(Input::get('category_name') AND !empty(Input::get('category_description'))))
            {
                $category = (new CategoriesTable)->add(null, Input::get('category_name'), Input::get('category_description'));
                Session::set('alerts',  [ \Libs\Languages::temporarilySet(['tr_TR' => 'Kategori eklendi.', 'en_US' => 'Category added.'])]);
                Response::back(0.05);
            }
            else
            {
                Session::set('errors', [ \Libs\Languages::temporarilySet(['tr_TR' => 'Lütfen boş alan bırakmayınız.', 'en_US' => 'Please do not leave blank input field.'])]);
                Response::back(0.05);
            }

        }
    }

    public function delete($id)
    {
        if(is_numeric($id))
        {
            $category = CategoriesTable::find($id);
            $category->deleted = 1;
            $category->save();
            if($category[0])
            {
                Session::set('alerts', [ \Libs\Languages::temporarilySet(['tr_TR' => 'Kategori silindi.', 'en_US' => 'Category deleted.'])]);
                Response::back(0.1);
            }
        }
    }

}