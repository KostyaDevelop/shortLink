<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Links;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function shortLink(Request $request){

        //Валидируем ссылку в формате json - {'url' => 'Нужная ссылка'}
        $validator = Validator::make($request->all(),[
            'url' => 'required|url'
        ]);

        //Передаем оишбку 400 с сообщением при непрохождении валидации
        if($validator->fails())
        {
            return response("This url not valid", 400);
        }

        //Генерируем и делаем новую ссылку
        $random_str = Str::random(6);
        $links_finish = 'http://localhost/task/public/shorlinktake/' . $random_str;

        //Заносим начальную и конечную ссылки в бд
        Links::create([
            'links_start' => $request->url,
            'links_finish' => $links_finish
        ]);

        // Запаковываем ссылку в json, убирая лишнии слэши параметром JSON_UNESCAPED_SLASHES
        $url = [
            'url' => $links_finish
        ];
        $url_json = json_encode($url, JSON_UNESCAPED_SLASHES);

        //Возавращаем короткую ссылку
        return $url_json;
    }
}

