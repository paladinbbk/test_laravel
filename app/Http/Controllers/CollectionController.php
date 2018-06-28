<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Collection;
use App\File;
use FormBuilder;
use App\Forms\CollectionForm;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::all();

        return view('collections.index')
            ->with('collections', $collections);
    }

    public function edit(Collection $collection)
    {
        $form = FormBuilder::create(CollectionForm::class,
            [
                'method' => 'PUT',
                'route' => ['collection.update', $collection],
                'model' => $collection
            ]
        );

        return view('collections.create', ['form' => $form]);
    }

    public function update(Collection $collection, Request $request)
    {
        if (auth()->user()->can('update', $collection)) {
            $collection->name = $request->get('name');
            $collection->save();

            return redirect()->route('collection.index')
                ->with('flash_success', 'collection updated!');
        }

        return redirect()->route('collection.index')->withErrors(['permission denied']);
    }

    public function show(Collection $collection)
    {
        $user = auth()->user();
        $files = $collection->files;

        $filesNotInCollection = File::notInCollection($collection)->get();
        $sum = $collection->files->sum('cost') ?? 0;

        return view('collections.show')
            ->with('sum', $sum)
            ->with('files', $files)
            ->with('user', $user)
            ->with('collection', $collection)
            ->with('filesNotInCollection', $filesNotInCollection);
    }

    public function create()
    {
        $form = FormBuilder::create(CollectionForm::class,
            [
                'method' => 'POST',
                'route' => 'collection.store',
            ]
        );

        return view('collections.create')
            ->with('form', $form);
    }

    public function store(Collection $collection, Request $request)
    {
        $collection->user_id = auth()->id();
        $collection->name = $request->get('name');
        $collection->save();

        return redirect()->route('collection.index');
    }

    public function add(Collection $collection, Request $request)
    {
        $file = File::find($request->get('id'));

        if ($file !== null) {
            $collection->files()->attach($file->id);

            return redirect()->back()
                ->with('flash_success', "File '{$file->url}'  was successfully added to the'{$collection->name}'  collection ");
        }

        return redirect()->back()->withErrors(['error']);
    }

    public function deleteFileFromCollection(Collection $collection, File $file)
    {
        $collection->files()->detach($file->id);

        return redirect()->back()
            ->with('flash_success', "File '{$file->url}'  was successfully removed from the  '{$collection->name}' collection");
    }

    public function delete(Collection $collection)
    {
        if (auth()->user()->can('delete', $collection)) {
            $collection->delete();

            return redirect()->route('collection.index')
                ->with('flash_success', 'collection deleted!');
        }

        return redirect()->route('collection.index')->withErrors(['permission denied']);
    }
}
