<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File notInCollection(\App\Collection\ $collection)
 */
class File extends Model
{
    const COST = 0.001;

    protected $table = 'files';

    protected $fillable = ['patch', 'url', 'cost', 'size'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function scopeNotInCollection(Builder $query, Collection $collection)
    {
        return $query->whereDoesntHave('collections', function (Builder $q) use ($collection) {
            $q->where('collections.id', $collection->id);
        });
    }
}
