<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 04.05.2017
 * Time: 23:48
 */

namespace App\Production\Http\Controller;
use Database\Databases\Ntblog\CategoriesTable;
use Database\Databases\Ntblog\ArticlesTable;
use Database\Databases\Model\ParentModel;
use duncan3dc\Laravel\Blade;

require "Home.php";

class Category
{

    public function index($name, $id)
    {
        $data = (new Home())->core();
        $category = (new CategoriesTable)->where('permalink', '=', $name)->andWhere('id', '=', $id)->execute()->first();
        $data['title_head'] = $category->name . ' - ' . ParentModel::getTitle();
        $articles = (new ArticlesTable())->where('deleted', '=', '0')->andWhere('category_id', '=', $category->id)->execute();
        if($articles != false)
        {
            $data['posts'] = $articles->all();
        }
        else
        {
            $data['posts'] = false;
        }
        echo Blade::render('category', $data);
    }

}