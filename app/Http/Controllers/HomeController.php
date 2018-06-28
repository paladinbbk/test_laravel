<?php

namespace App\Http\Controllers;

use FormBuilder;
use Illuminate\Http\Request;
use App\Forms\ParceForm;
use App\File;
use File as FileObj;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form = FormBuilder::create(ParceForm::class);

        return view('welcome')->with('form', $form);
    }

    public function showFile($name)
    {
        $file = File::where('patch', 'like', '%' . $name)->first();

        if ($file !== null) {
            return iconv("windows-1251", "utf-8", FileObj::get(storage_path('app/' . $file->patch)));
        }

        return redirect()->route('file.index')->withErrors(["not found file '{$name}'"]);
    }
}
