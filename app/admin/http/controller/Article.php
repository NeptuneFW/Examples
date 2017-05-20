<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 27.04.2017
 * Time: 19:45
 */

namespace App\Admin\Http\Controller;

use Database\Databases\Ntblog\ArticlesTable;
use Database\Databases\Ntblog\CategoriesTable;
use duncan3dc\Laravel\Blade;
use Libs\Assets\HelperFunctions;
use Libs\Input;
use System\Helper;
use System\Response;
use System\Session;

require "Category.php";

class Article
{

    use \System\Core;

    public function index()
    {
        $data = (new Category)->core();
        $articles = $this->articlesListCore();
        $data['articles'] = $articles[0];
        $data['page_articles'] = $articles[1];
        $data['categories_for_post'] = (new CategoriesTable)->where('deleted', '=', '0')->execute()->all();
        $data['js'] .= $this->assets->getAssetsGroup('tinyMCE')->useAllAssets('js')->returnedData;

        echo Blade::render('admin/article', $data);
    }

    public function add()
    {
        $data = (new Category)->core();
        $data['js'] .= $this->assets->getAssetsGroup('tinyMCE')->useAllAssets('js')->returnedData;
        $data['categories_for_post'] = (new CategoriesTable)->where('deleted', '=', '0')->execute()->all();

        echo Blade::render('admin/article/add', $data);
    }

    public function addPost()
    {

        if(Input::exists())
        {
            if(!empty(Input::get('article_title') AND !empty(Input::get('article_content'))))
            {
                $article = ArticlesTable::add(null, Input::get('article_title'), Input::get('article_content'), null, Helper::permalink(Input::get('article_title')), null, Session::get('id'), 0, Input::get('post_category'), 0);
                Session::set('alerts',  [ \Libs\Languages::temporarilySet(['tr_TR' => 'Makale eklendi.', 'en_US' => 'Article added.'])]);
                Response::back(0.05);
            }
            else
            {
                Session::set('errors', [ \Libs\Languages::temporarilySet(['tr_TR' => 'Lütfen boş alan bırakmayınız.', 'en_US' => 'Please do not leave blank input field.'])]);
                Response::back(0.05);
            }

        }
    }

    public function list()
    {
        $data = (new Category)->core();
        $articles = $this->articlesListCore();
        $data['articles'] = $articles[0];
        $data['page_articles'] = $articles[1];
        $data['js'] .= $this->assets->getAssetsGroup('tinyMCE')->useAllAssets('js')->returnedData;

        echo Blade::render('admin/article/list', $data);
    }

    public function delete($id)
    {
        if (is_numeric($id)) {
            $article = ArticlesTable::find($id);
            $article->deleted = 1;
            $article2 = $article->save();
            var_dump($article2);
            if ($article2[0]) {
                Session::set('alerts', [\Libs\Languages::temporarilySet(['tr_TR' => 'Makale silindi.', 'en_US' => 'Article deleted.'])]);
                Response::back(0.1);
            }
        }
    }

    public function articlesListCore($record = 10)
    {
        $categoryCount = ArticlesTable::count();
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

        $data = ArticlesTable::orderBy('DESC', $where . ',' . $record, "deleted=0");
        if(!$data)
        {
            return [false, 0];
        }
        else
        {
            return [$data->all(), $page_count];

        }

    }

    public function edit($id)
    {
        $data = (new Category)->core();
        $data['edit'] = true;
        $article = ArticlesTable::find($id);
        $data['name'] = $article->title;
        $data['js'] .= $this->assets->getAssetsGroup('tinyMCE')->useAllAssets('js')->returnedData;
        $data['description'] = $article->content;

        echo Blade::render('admin/article/add', $data);
    }

    public function editPost($id)
    {
        if(Input::exists())
        {
            if(!empty(Input::get('article_title') AND !empty(Input::get('article_content'))))
            {
                $article = ArticlesTable::find($id);
                $article->title = Input::get('article_title');
                $article->permalink = Helper::permalink(Input::get('article_title'));
                $article->content = Input::get('article_content');
                $return = $article->save();
                if($return[0])
                {
                    Session::set('alerts',  [ \Libs\Languages::temporarilySet(['tr_TR' => 'Makale güncellendi.', 'en_US' => 'Article updated.'])]);
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

}