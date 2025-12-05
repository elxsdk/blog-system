<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id',];

    protected $with = ['author', 'category'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        if ($search = $filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($category = $filters['category'] ?? false) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        if ($author = $filters['author'] ?? false) {
            $query->whereHas('author', function ($query) use ($author) {
                $query->where('username', $author);
            });
        }
    }
}
