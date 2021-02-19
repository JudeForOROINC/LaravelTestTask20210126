<?php

namespace App\Helpers;

use \Illuminate\Support\Facades\Route;

/*
 * Класс предназначенный для расширения возможностей определения
 * правильного роутинга текущей страницы, чтобы выделить "активную" ссылку
 * */

class RouteSection  {

    // метод перебирает имена роутов пока не найдет совпадение хотябы одного,
    //  чтобы подтвердить, что мы находимся на нужной ссылке
    public static function IsNeedSection(...$sectionNames): ? bool
    {
        $currentSectionName = Route::currentRouteName();
        foreach ($sectionNames as $sectionName)
            if( substr($currentSectionName,0,strlen($sectionName)) == $sectionName )
                return true;

        return false;
    }

}
