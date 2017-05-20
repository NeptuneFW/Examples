<?php
/**
 * Created by PhpStorm.
 * User: Peker
 * Date: 18.04.2017
 * Time: 19:21
 */

namespace Database\Databases\Model;
use Database\Databases\Ntblog\LanguagesTable;
use Database\Databases\Ntblog\SettingsTable;
use Libs\Languages;

class ParentModel
{

    public static function getTitle()
    {
        return Languages::temporarilySet(unserialize(SettingsTable::all()->first()->site_title));
    }

    public static function getLanguages()
    {
        return LanguagesTable::all(null, 'array');
    }

}