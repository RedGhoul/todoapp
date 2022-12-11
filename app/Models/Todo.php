<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function scopeFilter($query, array $filters){
        if($filters['keyword'] ?? false){
            $finalString = trim(htmlentities($filters['tag'],
                ENT_QUOTES, 'UTF-8', false));
            $query->whereRaw('searchtext @@ to_tsquery(\'english\', ?)', [$finalString])
                ->orderByRaw('ts_rank(searchtext, to_tsquery(\'english\', ?)) DESC', [$finalString]);
        }

    }

}
