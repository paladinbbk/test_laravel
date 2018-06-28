<?php

namespace App\Services;

use App\File as FileModel;
use Illuminate\Http\File;
use Storage;

class FileManager
{
    public function save($file, $dir, $filename, $url)
    {
        $patch = $dir . $filename . '.html';
        Storage::put($patch, $file);

        return $this->createDbRecord($patch, $url);
    }

    public function delete(FileModel $file)
    {
        if ($file->delete()) {
            return Storage::delete($file->patch);
        }

        return false;
    }

    public function createDbRecord($patch, $url)
    {
        $kb = round((Storage::size($patch) / 1024), 2);

        $file = new FileModel();

        $file->user_id = auth()->guard('web')->id();
        $file->patch = $patch;
        $file->url = $url;
        $file->cost = $kb * FileModel::COST;
        $file->size = $kb;
        $file->save();

        return $file;
    }
}
