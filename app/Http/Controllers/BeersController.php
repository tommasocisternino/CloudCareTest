<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class BeersController extends Controller
{
    public function getBeersList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "length" => "integer|min:0|max:80|required",
            "start" => "integer|min:0|required",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $per_page = $request->get('length');
        $page = $request->get('start') /$request->get('length') + 1;

        $url = config("app.PUNK_API_BASE_PATH").config("app.BEERS_BASE_PATH")."?per_page=".$per_page."&page=".$page;
        $response = Http::withoutVerifying()->get($url);

        return response()->json([
            "recordsTotal" => 325,
            "recordsFiltered" => 325, //le ho contate, non vi è modo di sapere quanti record ci sono utilizzando una chiamata API apparentemente. il dato non viene restituito nella response
            "data" => $response->json()
        ]);
    }
}
