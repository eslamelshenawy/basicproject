<?php
namespace App\Http\Helpers;


use Illuminate\Support\Facades\URL;


class Helper
{
    public static function ArrayToString($array)
    {
        return implode (', ', $array );
    }

}