<?php

namespace App\Http\Controllers;

use App\Count;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InformationController extends Controller
{
    public function test(){


        return view('home.test');
    }

    public function result(Request $request)
    {

        $ch = curl_init('http://task/apiTest');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_HEADER, false);

        $html = curl_exec($ch);

        curl_close($ch);

        $arr = json_decode($html);

        $fromUrl = $arr->fromUrl;

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $fromUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        curl_close($ch);

        $curl  = curl_init($fromUrl);

        curl_setopt($curl ,CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_HEADER, false);

        $resultFromUrl = curl_exec($curl);


        $word = $arr->word;

        $count = substr_count($resultFromUrl,$word);


        $data = ["count" => $count,'word'=>$word];

        $data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);

        $urlTo = $arr->toUrl;

        $curl = curl_init($urlTo);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        // Принимаем в виде массива. (false - в виде объекта)
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );


        $result = curl_exec($curl);

        curl_close($curl);

        return view('home.result');
    }


    public function posTtestPost(Request $request){



        $save = new Count();

        $save->word = $request->word;
        $save->count = $request->count;

        $save->save();

        Log::info("Обработка формы");
        Log::info($request->count);
        Log::info($request->word);


    }


    public function apiTest(){


        $a = array("fromUrl"=> 'http://task/test', "toUrl"=> "http://task/test1", "word"=>"во");

        return json_encode($a, JSON_UNESCAPED_UNICODE);

    }


    public function view(){

        $results = Count::all();

        return view('home.view',['results'=>$results]);
    }

}
