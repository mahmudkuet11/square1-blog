<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function scopeSort(Builder $query)
    {
        if (!request()->has('sort')) {
            return $query;
        }

        return $query->orderBy(request()->get('sort'), request()->get('sort-dir', 'desc'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
