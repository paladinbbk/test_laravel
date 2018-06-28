<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ParserService;
use App\Http\Requests\Parser\Url as UrlRequest;

class ParserController extends Controller
{
    function parse(UrlRequest $request, ParserService $parser){
       $result = $parser->get_data($request->url);

       return redirect()->route('file.index')->with('flash_success', 'file created!');
    }
}
