<?php

namespace App\Services;

use App\Services\FileManager;
use Auth;

class ParserService
{
    protected $fileManager;

    public function __construct()
    {
        $this->fileManager = new FileManager();
    }

    public function get_data($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);

        $base = parse_url($url);
        $base = $base['scheme'] . '://' . $base['host'];
        $preg = preg_replace('~(?:src|action|href)=[\'"]\K/(?!/)[^\'"]*~', "$base$0", $data);
        $name = time() . str_random(20);

        return ['file' => $this->fileManager->save($preg, 'user' . Auth::id() . '/', $name, $url), 'show' => $preg];
    }
}
