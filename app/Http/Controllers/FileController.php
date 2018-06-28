<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\File as FileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use Storage;
use File as FileObj;
use App\Forms\FileForm;
use FormBuilder;
use App\Services\FileManager;
use App\Services\ParserService;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        $sum = File::sum('cost') ?? 0;
        $user = auth()->user();

        return view('files.index')
            ->with('files', $files)
            ->with('user', $user)
            ->with('sum', $sum);
    }

    public function show(File $file)
    {
        return iconv("windows-1251", "utf-8", FileObj::get(storage_path('app/' . $file->patch)));
    }

    public function create()
    {
        $form = FormBuilder::create(FileForm::class,
            [
                'method' => 'POST',
                'route' => 'file.store',
            ]
        );

        return view('files.edit', ['form' => $form]);
    }

    public function store(FileRequest $request, ParserService $parser)
    {
        $result = $parser->get_data($request->get('url'));

        $file = $result['file'];
        $file->url = $request->get('url');
        $file->cost = $request->get('cost');
        $file->saveOrFail();

        return redirect()->route('file.index')
            ->with('flash_success', 'file created!');
    }

    public function edit(File $file)
    {
        $form = FormBuilder::create(FileForm::class,
            [
                'method' => 'PUT',
                'route' => ['file.update', $file],
                'model' => $file
            ]
        );

        return view('files.edit', ['form' => $form, 'file' => $file]);
    }

    public function delete(File $file, FileManager $fileManager)
    {
        if (auth()->user()->can('delete', $file)) {
            if ($fileManager->delete($file)) {
                return redirect()->route('file.index')->with('flash_success', 'file deleted!');
            }
        }

        return redirect()->route('file.index')->withErrors(['permission denied']);
    }

    public function update(File $file, FileRequest $request)
    {
        if (auth()->user()->can('update', $file)) {
            $file->url = $request->get('url');
            $file->cost = $request->get('cost');
            $file->saveOrFail();

            return redirect()->back()
                ->with('flash_success', 'file updated!');
        }

        return redirect()->route('file.index')->withErrors(['permission denied']);
    }
}