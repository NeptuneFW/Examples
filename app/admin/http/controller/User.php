<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 01.05.2017
 * Time: 21:06
 */

namespace App\Admin\Http\Controller;

use Database\Databases\Ntuser\UsersTable;
use duncan3dc\Laravel\Blade;
use System\Response;
use Tarvos\Tarvos;

require_once "Category.php";

class User
{

    public function index()
    {
        $data = (new Category)->core();
        $users =  $this->userListCore();
        $data['users'] = $users[0];
        $data['page_users'] = $users[1];

        echo Blade::render('admin/user', $data);

    }

    public function ban($id)
    {
        $user = UsersTable::find($id);
        if($user)
        {
            if($user->banned == '1')
            {
                $user->banned = '0';
            }
            else
            {
                $user->banned = '1';
            }
            $user->save();
        }
        Response::back();
    }

    public function userListCore($record = 10)
    {
        $categoryCount = UsersTable::count();
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

        $data = UsersTable::orderBy('DESC', $where . ',' . $record, null, 'array');
        if(!$data)
        {
            return [false, 0];
        }
        else
        {
            return [$data, $page_count];

        }

    }

}