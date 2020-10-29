<?php

namespace App\Http\Controllers;

use App\Links;
use Illuminate\Http\Request;

class ShortLinkTakeController extends Controller
{
    publiC function  index($links_finish){

        //Берем генерируемую часть ссылки и соединяем с префиксом
        $links_finish_before = 'http://localhost/task/public/shorlinktake/' . $links_finish;

        //Находим строку с данной ссылкой в бд, поместив ее в переменную link
        $link = Links::where('links_finish', $links_finish_before)->first();

        //Удаляем данную строку, сделав этим нашу ссылку одноразовой
        Links::where('links_finish', $links_finish_before)->delete();

        //Вытаскиваем ссылку из link
        $get_links_start =  $link->links_start;

        //Возвращаем начальную ссылку
        return redirect()->away($get_links_start);
    }
}
