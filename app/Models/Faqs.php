<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Faqs extends Model
{
    use HasFactory, Searchable;

    protected $table = 'faqs';

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'question',
        'answer'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function toSearchableArray()
    {
        return [
            'questions' => $this->question,
            'answers' => $this->answer
        ];
    }
}
