<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}
